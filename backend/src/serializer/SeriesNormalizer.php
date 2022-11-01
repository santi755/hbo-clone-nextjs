<?php

namespace App\Serializer;

use App\Entity\Series;
use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class SeriesNormalizer implements ContextAwareNormalizerInterface
{
    private $normalizer;
    private $urlHelper;

    public function __construct(
        ObjectNormalizer $normalizer,
        UrlHelper $urlHelper
    ) {
        $this->normalizer = $normalizer;
        $this->urlHelper = $urlHelper;
    }

    public function normalize($serie, $format = null, array $context = [])
    {
        $data = $this->normalizer->normalize($serie, $format, $context);

        if (!empty($serie->getImagePath())) {
            $data['image_path'] = $this->urlHelper->getAbsoluteUrl('/storage/default/' . $serie->getImagePath());
        }

        return $data;
    }

    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Series;
    }
}