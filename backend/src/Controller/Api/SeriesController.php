<?php

namespace App\Controller\Api;

use App\Entity\Series;
use App\Form\Model\SeriesDto;
use App\Form\Type\SeriesFormType;
use App\Repository\SeriesRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use League\Flysystem\FilesystemOperator;

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
    public function postAction(EntityManagerInterface $em, Request $request, FileUploader $fileUploader)
    {
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

}