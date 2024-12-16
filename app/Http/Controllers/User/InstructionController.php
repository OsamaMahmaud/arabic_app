<?php

namespace App\Http\Controllers\User;

use App\Traits\ApiTrait;
use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstructionController extends Controller
{
    use ApiTrait;
    
    public function index()
    {
        try{

            $instructions = Instruction::all();
            if (empty($$instructions )) {
               return $this->ErrorMessage('لا يوجد تعليمات الان');
            }
            return  $this->SuccessMessage('instructions retrieved successfully',200,$instructions);

        }
        catch (\Exception $e) {
            // أي خطأ آخر
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while get the instructions.',
                'error' => $e->getMessage(),
            ], 500);
        }
     
    }

}
