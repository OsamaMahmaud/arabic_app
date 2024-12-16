<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Video;
use App\Traits\ApiTrait;

class SectionController extends Controller
{
    use ApiTrait;


    //get all sections
    public function getAll(){
        
    }
    public function index($level_id)
    {
        $sections =Video::where('level_id',$level_id)->get('section_name');

        $sections= SectionResource::collection($sections);

        return $this->SuccessMessage('Get All sections Successfully',200,$sections);

    }
}
