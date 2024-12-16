<?php

namespace App\Http\Controllers\User;

use App\Models\Term;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TermController extends Controller
{
    USE ApiTrait;
    
    public function index(){

        $term=Term::first();

        return $this->SuccessMessage('Terms and condtions retrieved successfully',200,$term);
    }
}
