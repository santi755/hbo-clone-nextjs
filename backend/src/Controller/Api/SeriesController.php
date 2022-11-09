<?php

namespace App\Controller\Api;

use App\Repository\SeriesRepository;
use App\Service\SeriesFormProcessor;
use App\Service\SeriesManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SeriesController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/series")
     * @Rest\View(serializerGroups={"serie"}, serializerEnableMaxDepthChecks=true)
     */
    public function getAction(SeriesManager $seriesManager)
    {
        return $seriesManager->getRepository()->findAll();
    }

    /**
     * @Rest\Post(path="/series")
     * @Rest\View(serializerGroups={"serie"}, serializerEnableMaxDepthChecks=true)
     */
    public function postAction(
        SeriesManager $seriesManager,
        SeriesFormProcessor $seriesFormProcessor,
        Request $request
    ) {
        $serie = $seriesManager->create();
        [$serie, $error] = ($seriesFormProcessor)($serie, $request);
        $statusCode = $serie ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST;
        $data = $serie ?? $error;
        return View::create($data, $statusCode);
    }

    /**
     * @Rest\Get(path="/series/{id}", requirements={"id"="\d+"})
     * @Rest\View(serializerGroups={"serie"}, serializerEnableMaxDepthChecks=true)
     */
    public function getSingleAction(
        int $id,
        SeriesManager $seriesManager
    ) {
        $serie = $seriesManager->find($id);
        if (!$serie) {
            return View::create('Book not found', Response::HTTP_BAD_REQUEST);
        }
        return $serie;
    }

    /**
     * @Rest\Post(path="/series/{id}", requirements={"id"="\d+"})
     * @Rest\View(serializerGroups={"serie"}, serializerEnableMaxDepthChecks=true)
     */
    public function editAction(
        int $id,
        SeriesFormProcessor $seriesFormProcessor,
        SeriesManager $seriesManager,
        Request $request
    ) {
        $serie = $seriesManager->find($id);
        if (!$serie) {
            return View::create('Book not found', Response::HTTP_BAD_REQUEST);
        }
        [$serie, $error] = ($seriesFormProcessor)($serie, $request);
        $statusCode = $serie ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST;
        $data = $serie ?? $error;
        return View::create($data, $statusCode);
    }

    /**
     * @Rest\Delete(path="/series/{id}", requirements={"id"="\d+"})
     * @Rest\View(serializerGroups={"serie"}, serializerEnableMaxDepthChecks=true)
     */
    public function deleteAction(
      int $id,
      SeriesManager $seriesManager,
      Request $request
  ) {
      $serie = $seriesManager->find($id);
      if (!$serie) {
          return View::create('Book not found', Response::HTTP_BAD_REQUEST);
      }

      $seriesManager->delete($serie);
      return View::create(null, Response::HTTP_NO_CONTENT);
  }
}