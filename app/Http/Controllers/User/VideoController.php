<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LevelContent;
use App\Models\Video;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use ApiTrait;
    public function getSections($levelid)
    {
        // Fetch content by level_id using query builder
        $content = Video::where('level_id', $levelid)
        ->select('type','image','description')
        ->distinct()
        ->get();

        if ($content->isEmpty()) {
            return $this->ErrorMessage('No content found for this level');
        }

        return $this->SuccessMessage('content retrieved successfully',200,$content);
       
    }


    public function getSectionVideos($level_id, $type)
    {
        $videos = Video::where('level_id', $level_id)
                              ->where('section_name', $type)
                              ->get(['id', 'title', 'description', 'image','url']);

        return $this->SuccessMessage('content retrieved successfully',200,$videos);             
        // return response()->json($videos);
    }
}

