<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    USE ApiTrait;
    
    public function index(){

        $about=About::first();
        $aboutList = $about ? $about->toArray() : [];

        return $this->SuccessMessage('About-us retrieved successfully', 200, $aboutList);
    }
}
