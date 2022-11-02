<?php

namespace App\Form\Model;

use App\Entity\Series;

class SeriesDto {
    public $name;
    public $title;
    public $subtitle;
    public $base64Image;
    public $categories;

    public function __construct()
    {
        $this->categories = [];
    }

    public static function createFromSerie(Series $serie): self
    {
        $dto = new self();
        $dto->name = $serie->getName();
        $dto->title = $serie->getTitle();
        $dto->subtitle = $serie->getSubtitle();
        return $dto;
    }
}