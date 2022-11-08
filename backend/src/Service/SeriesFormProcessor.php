<?php

namespace App\Service;

use App\Entity\Series;
use App\Form\Model\CategoryDto;
use App\Form\Model\SeriesDto;
use App\Form\Type\SeriesFormType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class SeriesFormProcessor
{

    private $seriesManager;
    private $categoryManager;
    private $fileUploader;
    private $formFactory;

    public function __construct(
        SeriesManager $seriesManager,
        CategoryManager $categoryManager,
        FileUploader $fileUploader,
        FormFactoryInterface $formFactory
    )
    {
        $this->seriesManager = $seriesManager;
        $this->categoryManager = $categoryManager;
        $this->fileUploader = $fileUploader;
        $this->formFactory = $formFactory;
    }

    public function __invoke(Series $serie, Request $request): array
    {
        $serieDto = SeriesDto::createFromSerie($serie);

        $originalCategories = new ArrayCollection();
        foreach ($serie->getCategories() as $category) {
            $categoryDto = CategoryDto::createFromCategory($category);
            $serieDto->categories[] = $categoryDto;
            $originalCategories->add($categoryDto);
        }

        $form = $this->formFactory->create(SeriesFormType::class, $serieDto);
        $form->handleRequest($request);
        if (!$form->isSubmitted()) {
            return [null, 'Form is not submitted'];
        }
        if ($form->isValid()) {
          // Remove Categories
          foreach ($originalCategories as $originalCategoryDto) {
              if (!in_array($originalCategoryDto, $serieDto->categories)) {
                  $category = $this->categoryManager->find($originalCategoryDto->id);
                  $serie->removeCategory($category);
              }
          }

          // Add Categories
          foreach ($serieDto->categories as $newCategoryDto) {
              if (!$originalCategories->contains($newCategoryDto)) {
                  $category = $this->categoryManager->find($newCategoryDto->id ?? 0);
                  if (!$category) {
                    $category = $this->categoryManager->create();
                    $category->setName($newCategoryDto->name);
                    $this->categoryManager->save($category);
                  }
                  $serie->addCategory($category);
              }
          }

          $serie->setName($serieDto->name);
          $serie->setTitle($serieDto->title);
          $serie->setSubtitle($serieDto->subtitle);
          if ($serieDto->base64Image) {
              $filename = $this->fileUploader->uploadBase64File($serieDto->base64Image);
              $serie->setImagePath($filename);
          }
          $this->seriesManager->save($serie);
          $this->seriesManager->reload($serie);
          return [$serie, null];
        }
        return [null, $form];
    }
}