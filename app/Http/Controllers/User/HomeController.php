<?php

namespace App\Http\Controllers\User;

use App\Models\Slider;
use App\Models\IntroVideo;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   use ApiTrait;

    public function getSliders()
    {
        // استرجاع بيانات الـ Slider
        $sliders = Slider::all();
        // استرجاع الفيديو التعريفي
        return $this->SuccessMessage('Get  slider Successfully',200,$sliders);
    }

    public function getIntroVideo(){
        $introVideo = IntroVideo::first();

        return $this->SuccessMessage('Get introVideo Successfully',200,$introVideo);
    }
}
