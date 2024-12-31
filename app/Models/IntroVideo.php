<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class IntroVideo extends  Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    const PATH='intro_video';

    protected $fillable = ['video_url'];

    protected $hidden=['created_at','updated_at'];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('intro_video')
             ->useDisk('media'); // استخدم محرك التخزين الذي أنشأته مسبقًا
    }
}
