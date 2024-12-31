<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Slider extends  Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    const PATH='slider';

    protected $fillable = ['title','description','image_path'];



    public function registerMediaCollections(): void
   {
    $this->addMediaCollection('slider_images')
         ->acceptsMimeTypes(['image/jpeg', 'image/png'])
         ->useDisk('media'); // تأكد من أن هذا يشير إلى المحرك الصحيح
   }
    protected $hidden=['created_at','updated_at'];

}
