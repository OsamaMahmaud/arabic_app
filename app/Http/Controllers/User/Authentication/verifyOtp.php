<?php

namespace App\Http\Controllers\User\Authentication;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class verifyOtp extends Controller
{
    public function verifyOtp(Request $request)
    {
        // التحقق من صحة الإدخال
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string',
        ]);

        // التحقق من صحة OTP باستخدام المكتبة
        $otp = new Otp(); // كائن OTP
        $otpValidation = $otp->validate($request->email, $request->otp); // التحقق من OTP

        if ($otpValidation->status) {
            // البحث عن المستخدم
            $user = User::where('email', $request->email)->firstOrFail();

            // تحديث الحقل otp_verified
            $updateStatus = $user->update(['otp_verified' => true]);

            if ($updateStatus) {
                return response()->json(['message' => 'OTP verified successfully'], 200);
            } else {
                return response()->json(['message' => 'Failed to update OTP verification status'], 500);
            }
        } else {
            return response()->json(['message' => 'Invalid OTP'], 422);
        }
    }
}
