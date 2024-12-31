<?php

namespace App\Services;


use App\Models\Slider;
use App\Models\IntroVideo;
use  App\Models\Video;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

/**
 * Class CustomPathGenerator
 * @package App\MediaLibrary
 */
class CustomMediaPathGenerator extends DefaultPathGenerator
{
    /**
     * @param Media $media
     *
     * @return string
     */
    public function getPath(Media $media): string
    {
        switch ($media->model_type) {
            case Slider::class:
                return Slider::PATH . DIRECTORY_SEPARATOR . $media->collection_name . DIRECTORY_SEPARATOR . $media->id . DIRECTORY_SEPARATOR;
              break;

              case IntroVideo::class:
                return IntroVideo::PATH . DIRECTORY_SEPARATOR . $media->collection_name . DIRECTORY_SEPARATOR . $media->id . DIRECTORY_SEPARATOR;
              break;

              case Video::class:
                return Video::PATH . DIRECTORY_SEPARATOR . $media->collection_name . DIRECTORY_SEPARATOR . $media->id . DIRECTORY_SEPARATOR;
              break;


            default:
                return $media->id . DIRECTORY_SEPARATOR;
        }
    }
  

}