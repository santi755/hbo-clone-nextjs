<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    /**
     * @Route("/series/list", name="series_list")
     */
    public function list() {
        $response = new JsonResponse();
        $response->setData([
          'success' => true,
          'data' => [
            [
              'id' => 1,
              'title' => 'Rick and Morty'
            ],
            [
              'id' => 2,
              'title' => 'Lo que sea'
            ]
          ]
        ]);
        return $response;
    }
}