<?php

namespace App\Http\Controllers\User;

use App\Models\Privacy;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    USE ApiTrait;
    
    public function index(){
        try{
            
        $privacy=Privacy::first();
        if(empty($privacy))
        {
            return $this->ErrorMessage('Privacy Policy Not Found');
        }

        return $this->SuccessMessage('privacy retrieved successfully',200,$privacy);
        }
        catch(\Exception $e){
            return $this->ErrorMessage('Error Occured');
            }

    }
    
}
