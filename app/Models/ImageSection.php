<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageSection extends Model
{
    use HasFactory;


    protected $fillable = ['section_name', 'image_path'];

    // العلاقة مع الفيديوهات
    public function videos()
    {
        return $this->hasMany(Video::class, 'section_name', 'section_name');
    }
}
