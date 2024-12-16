<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'title', 'description', 'url','image'];


    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    
}
