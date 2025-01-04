<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Video extends  Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    const PATH='videos';

    protected $fillable = ['section_name', 'title', 'description', 'url','image','level_id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('video_image')
        ->acceptsMimeTypes(['image/jpeg','image/png'])
        ->useDisk('media');
       
        $this->addMediaCollection('video_url')
        ->useDisk('media');
            
    }

    //relations
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function imageSection()
    {
        return $this->belongsTo(ImageSection::class, 'section_name', 'section_name');
    }

    
}
