<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price'];

    protected $hidden=['created_at','updated_at','level_count'];

    


    public function levels()
    {
        return $this->belongsToMany(Level::class , 'package__levels','package_id','level_id');
    }


}
