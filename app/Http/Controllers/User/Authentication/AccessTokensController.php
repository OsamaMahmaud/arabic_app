<?php

namespace App\Http\Controllers\User\Authentication;

use App\Http\Requests\User\LoginUser;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessTokensController extends Controller
{

    use ApiTrait;

   public function login(LoginUser $request)
    {
        // التحقق من صحة البيانات المدخلة

        $user = User::where('email', $request->email)->first();    
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'بيانات دخول غير صحيحة']);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->Data(compact('user','token'),'تم تسجيل الدخول بنجاح',200);

        // return response()->json([
        //     'user' => $user,
        //     'token' => $token,
        // ], 200);
         
        

    }


  public function destroy($token = null)
{
    if (null === $token) {
         Auth::user()->tokens()->delete();
     return response()->json(['message' => 'Logged out successfully'], 200);
    }

    // $user->tokens()->delete();

    // return response()->json(['message' => 'All tokens revoked successfully'], 200);
}

}