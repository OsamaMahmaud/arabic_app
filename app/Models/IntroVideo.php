<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntroVideo extends Model
{
    use HasFactory;
    protected $fillable = ['video_url'];

    protected $hidden=['created_at','updated_at'];
}
