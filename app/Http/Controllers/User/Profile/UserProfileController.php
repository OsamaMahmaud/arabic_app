<?php

namespace App\Http\Controllers\User\Profile;

use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\EditProfileResource;
use App\Http\Resources\updateProfileResource;
use App\Http\Requests\User\UserProfileRequest;

class UserProfileController extends Controller
{
    use ApiTrait;
    // public function changePassword(UserProfileRequest $request)
    // {
      
    //     $user = Auth::user();
    //     // Check if current password is correct
    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return $this->ErrorMessage('Current password is incorrect', 403);
    //     }
    //     // Update the password
    //     $user->password = Hash::make($request->new_password);

    //     $user->save();

    //     return $this->SuccessMessage( 'Password changed successfully');
    
    // }

    //edit user
    public function show(Request $request)
    {
      
        return $this->SuccessMessage(' data retrived successfuly',200,new EditProfileResource($request->user()));
    }
    
    public function updateProfile(UserProfileRequest $request)
    {
        
        // تحديث بيانات المستخدم
        $user = Auth::user();
        $user->fullname = $request->fullname ?? $user->fullname;
        $user->email = $request->email ?? $user->email;

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return $this->SuccessMessage('Profile updated successfully',200, new updateProfileResource( $user));
    }


    public function changePhoto(Request $request)
{
    $user = Auth::user();

    // التحقق من وجود ملف مرفق
    if ($request->hasFile('image')) {
        // التحقق من أن الملف صورة
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // حذف الصور السابقة من المجموعة
        $user->clearMediaCollection('profile_images');

        // إضافة الصورة الجديدة باستخدام المكتبة
        $user->addMediaFromRequest('image')
            ->usingFileName($user->fullname . '_image.' . $request->file('image')->getClientOriginalExtension())
            ->toMediaCollection('profile_images');
    }

    // حفظ التغييرات (اختياري إذا كنت تريد تحديث أي بيانات أخرى)
    $user->save();

        // الرد بنجاح مع الصورة الجديدة

    return $this->SuccessMessage('Profile photo updated successfully',200,$user->getFirstMediaUrl('profile_images'));

    
}








    
}
