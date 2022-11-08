<?php

namespace App\Service;

use App\Entity\Series;
use App\Repository\SeriesRepository;
use Doctrine\ORM\EntityManagerInterface;

class SeriesManager
{
    private $em;
    private $seriesRepository;

    public function __construct(EntityManagerInterface $em, SeriesRepository $seriesRepository)
    {
        $this->em = $em;
        $this->seriesRepository = $seriesRepository;
    }

    public function find(int $id): Series
    {
        return $this->seriesRepository->find($id);
    }

    public function getRepository(): SeriesRepository
    {
        return $this->seriesRepository;
    }

    public function create(): Series
    {
        $serie = new Series();
        return $serie;
    }

    public function save(Series $serie): Series
    {
        $this->em->persist($serie);
        $this->em->flush();
        return $serie;
    }

    public function reload(Series $serie): Series
    {
        $this->em->refresh($serie);
        return $serie;
    }

    public function delete(Series $serie)
    {
        $this->em->remove($serie);
        $this->em->flush();
    }
}