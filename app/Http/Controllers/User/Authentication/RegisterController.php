<?php
namespace App\Http\Controllers\User\Authentication;

use App\Models\User;
use App\Traits\ApiTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\RegisterUser;

class RegisterController extends Controller
{

    use ApiTrait;

    public function register(RegisterUser $request)
    {
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        $user->assignDefaultProfileImage();
        
        // dd($user); // تحقق من البيانات المخزنة
        
        return $this->SuccessMessage('تم إنشاء الحساب بنجاح', 200, new UserResource($user));
    }

}