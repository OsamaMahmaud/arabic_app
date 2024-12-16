<?php

namespace App\Http\Controllers\User\Authentication;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    public function resetPassword(ResetPasswordRequest $request)
 {


    $user = User::where('email', $request->email)->first();

    // التحقق من حالة التحقق من OTP
    if (!$user->otp_verified) {
        return response()->json(['message' => 'OTP verification is required'], 403);
    }

    // تحديث كلمة المرور
    $user->update(['password' => Hash::make($request->password), 'otp_verified' => false]); // إعادة تعيين الحالة

    return response()->json(['message' => 'Password reset successfully'], 200);
 }
    
}
