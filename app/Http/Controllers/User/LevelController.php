<?php

namespace App\Http\Controllers\User;

use App\Models\Level;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LevelResource;

class LevelController extends Controller
{
    use ApiTrait;
    
    // public function index()
    // {
    //     $levels =Level::withCount('videos')->get();

    //     $levels= LevelResource::collection($levels);

    //     return $this->SuccessMessage('Get All levels Successfully',200,$levels);

    // }

    public function index(Request $request)
   {
     try{

          $accessibleLevels = $request->input('accessibleLevels'); // المستويات المسموح بها

          // جلب المستويات المسموح بها فقط
          $levels = Level::whereIn('id', $accessibleLevels)->withCount('videos')->get();
  
          $levels = LevelResource::collection($levels);
          if(empty($levels))
          {
            return $this->SuccessMessage('No levels found',200,$levels);
          }
  
          return $this->SuccessMessage('Get Accessible Levels Successfully', 200, $levels);

     }
     catch(\Exception $e)
     {
          return $this->ErrorMessage('Error in getting levels', 500, $e->getMessage());
     }
       
   }
}
