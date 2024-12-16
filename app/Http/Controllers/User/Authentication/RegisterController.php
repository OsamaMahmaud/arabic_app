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
    // إنشاء المستخدم
    $user = User::create($request->safe([
       'fullname' => $request->fullname,
        'email' => $request->phone,
        'password' => bcrypt($request->password),

    ]));
    
    $user->assignDefaultProfileImage();
     
   
    // if ($request->hasFile('image')) {

    // $user->addMediaFromRequest('image')
    //    ->usingFileName($request->fullname . '_image.' . $request->file('image')->getClientOriginalExtension())
    //    ->toMediaCollection('user_images'); // store new image         
    // }
    // $token = $user->createToken('auth_token')->plainTextToken;

   
    return $this->SuccessMessage('تم إنشاء الحساب بنجاح',200,new UserResource($user));
 
}


}
