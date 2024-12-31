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

    protected $fillable = ['section_id', 'title', 'description', 'url','image','level_id'];

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
    
}
