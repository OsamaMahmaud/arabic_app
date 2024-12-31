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
    // public function index($level_id)
    // {
    //     $sections =Video::where('level_id',$level_id)->get('section_name');

    //     $sections= SectionResource::collection($sections);

    //     return $this->SuccessMessage('Get All sections Successfully',200,$sections);

    // }

    public function index($level_id)
{
    $data = Video::where('level_id', $level_id)
        ->select('section_name')
        ->selectRaw('COUNT(*) as videos_count')
        ->groupBy('section_name')
        ->get();

    $sections = SectionResource::collection($data);

    return $this->SuccessMessage('Get All sections Successfully', 200, $sections);
}
}
