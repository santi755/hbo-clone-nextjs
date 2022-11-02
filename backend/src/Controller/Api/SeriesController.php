<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Entity\Series;
use App\Form\Model\CategoryDto;
use App\Form\Model\SeriesDto;
use App\Form\Type\SeriesFormType;
use App\Repository\CategoryRepository;
use App\Repository\SeriesRepository;
use App\Service\FileUploader;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\HttpFoundation\Response;

class SeriesController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/series")
     * @Rest\View(serializerGroups={"serie"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(SeriesRepository $seriesRepository)
    {
        return $seriesRepository->findAll();
    }

    /**
     * @Rest\Post(path="/series")
     * @Rest\View(serializerGroups={"serie"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(
        EntityManagerInterface $em,
        Request $request,
        FileUploader $fileUploader
    ) {
        $serieDto = new SeriesDto();
        $form = $this->createForm(SeriesFormType::class, $serieDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filename = $fileUploader->uploadBase64File($serieDto->base64Image);

            $serie = new Series();
            $serie->setName($serieDto->name);
            $serie->setTitle($serieDto->title);
            $serie->setSubtitle($serieDto->subtitle);
            $serie->setImagePath($filename);

            $em->persist($serie);
            $em->flush();
            return $serie;
        }

        return $form;
    }

    /**
     * @Rest\Post(path="/series/{id}", requirements={"id"="\d+"})
     * @Rest\View(serializerGroups={"serie"}, serializerEnableMaxDepthChecks=true)
     */
    public function editAction(
        int $id,
        EntityManagerInterface $em,
        SeriesRepository $seriesRepository,
        CategoryRepository $categoryRepository,
        Request $request,
        FileUploader $fileUploader
    ) {
        $serie = $seriesRepository->find($id);
        if (!$serie) {
            throw $this->createNotFoundException('Serie not found');
        }
        $serieDto = SeriesDto::createFromSerie($serie);

        $originalCategories = new ArrayCollection();
        foreach ($serie->getCategories() as $category) {
            $categoryDto = CategoryDto::createFromCategory($category);
            $serieDto->categories[] = $categoryDto;
            $originalCategories->add($categoryDto);
        }

        $form = $this->createForm(SeriesFormType::class, $serieDto);
        $form->handleRequest($request);
        if (!$form->isSubmitted()) {
            return new Response('', Response::HTTP_BAD_REQUEST);
        }
        if ($form->isValid()) {
          // Remove Categories
          foreach ($originalCategories as $originalCategoryDto) {
              if (!in_array($originalCategoryDto, $serieDto->categories)) {
                  $category = $categoryRepository->find($originalCategoryDto->id);
                  $serie->removeCategory($category);
              }
          }

          // Add Categories
          foreach ($serieDto->categories as $newCategoryDto) {
              if (!$originalCategories->contains($newCategoryDto)) {
                  $category = $categoryRepository->find($newCategoryDto->id ?? 0);
                  if (!$category) {
                    $category = new Category();
                    $category->setName($newCategoryDto->name);
                    $em->persist($category);
                  }
                  $serie->addCategory($category);
              }
          }

          $serie->setName($serieDto->name);
          $serie->setTitle($serieDto->title);
          $serie->setSubtitle($serieDto->subtitle);
          if ($serieDto->base64Image) {
              $filename = $fileUploader->uploadBase64File($serieDto->base64Image);
              $serie->setImagePath($filename);
          }
          $em->persist($serie);
          $em->flush();
          $em->refresh($serie);
          return $serie;
        }
        return $form;
    }
}