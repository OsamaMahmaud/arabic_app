<?php

namespace App\Http\Controllers\User\Authentication;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ForgetPasswordRequest;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Notifications\ResetPassword;

class FoegetPasswordController extends Controller
{
    
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $email = $request->input('email');
        $user =User::where('email', $email)->first();
        //notify
         $user->notify(new ResetPasswordNotification());
         return response()->json(['message' => 'Password reset link sent to your email'], 200);

    }



}
