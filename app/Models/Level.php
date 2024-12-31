<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'lessions_count'];




    public function videos()
    {
        return $this->hasMany(Video::class);
    }
    

    // public function videos()
    // {
    //     return $this->hasManyThrough(Video::class, Section::class);
    // }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package__levels','level_id','package_id');
    }

}
