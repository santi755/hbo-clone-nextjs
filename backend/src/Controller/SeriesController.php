<?php

namespace App\Controller;

use App\Entity\Series;
use App\Repository\SeriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class SeriesController extends AbstractController
{
    /**
     * @Route("/series/list", name="series_list")
     */
    public function list(Request $request, SeriesRepository $seriesRepository) {
        $series = $seriesRepository->findAll();
        $seriesAsArray = [];
        foreach ($series as $serie) {
          $seriesAsArray[] = [
            'id' => $serie->getId(),
            'title' => $serie->getTitle(),
            'image_path' => $serie->getImagePath(),
            'name' => $serie->getName(),
            'subtitle' => $serie->getSubtitle()
          ];
        }

        $response = new JsonResponse();
        $response->setData([
          'success' => true,
          'data' => $seriesAsArray
        ]);
        return $response;
    }

    /**
     * @Route("/series/create", name="create_series")
     */
    public function createSerie(Request $request, EntityManagerInterface $em) {
        $serie = new Series();
        $serie->setName('Juego de tronos');
        $serie->setTitle('El titulo de juego de tronos');
        $serie->setSubtitle('El subtitulo de juego de tronos, El subtitulo de juego de tronos');
        $serie->setImagePath('/image');

        $em->persist($serie);
        $em->flush();

        $response = new JsonResponse();
        $response->setData([
          'success' => true,
          'data' => [
            [
              'id' => $serie->getId(),
              'title' => $serie->getTitle(),
              'image_path' => $serie->getImagePath(),
              'name' => $serie->getName(),
              'subtitle' => $serie->getSubtitle()
            ],
          ]
        ]);
        return $response;
    }
}