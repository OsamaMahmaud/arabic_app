<?php

namespace App\Http\Controllers\User;

use App\Models\Package;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    use ApiTrait;
    //get all packages
    public function index()
    {
      try{

        $packages = Package::all();
        if(empty($packages))
        {
          return $this->ErrorMessage('No packages found');
        }

         return $this->SuccessMessage('Get All Packages Successfully',200,$packages);

      }
      catch(\Exception $e)
      {
  
        return $this->ErrorMessage('Error in getting packages', 500, $e->getMessage());

      }
        

    }
}
