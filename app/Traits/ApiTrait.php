<?php

namespace App\Traits;

trait ApiTrait {
    public function SuccessMessage(string $message = "",int $code = 200,$data=[])
    {
        return response()->json(
            [
                'success'=>true,
                'message'=>$message,
                'data'=>$data,
            ],
            $code
        );
    }

    public function ErrorMessage( string $message = "",int $code = 422,$data=[])
    {
        return response()->json(
            [
                'success'=>false,
                'message'=>$message,
                'data'=>$data,
                // 'errors'=> $errors,
                // 'data'=>(object)[],
            ],
            $code
        );
    }

    public function Data( $data=[],string $message = "",int $code = 200)
    {
        return response()->json(
            [
                'success'=>true,
                'message'=>$message,
                'data'=>$data,
            ],
            $code
        );
    }
}