<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable , InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'image',
        'otp_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function registerMediaCollections(): void
    {
       
        $this->addMediaCollection('profile_images')
        ->acceptsMimeTypes(['image/jpeg','image/png'])
        ->useDisk('media');
            
    }


    public function assignDefaultProfileImage()
    {
        $defaultImagePath = public_path('media/default-profile.jpg');
        
        // تحقق من وجود الصورة
        if (file_exists($defaultImagePath)) {
            // حفظ الصورة في مجموعة 'profile_images'
            $this->addMedia($defaultImagePath)
                ->preservingOriginal()
                ->usingFileName($this->email . '_default-profile.jpg')  // اسم مخصص حسب المستخدم
                ->toMediaCollection('profile_images', 'media'); // تأكد من استخدام 'profile_images' هنا
        } else {
            throw new \Exception('Default profile image not found!');
        }
    }

    
    //relations
    


    
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id')->withDefault();
    }


    public function levels()
    {
        return $this->belongsToMany(Level::class, 'level__users', 'user_id', 'level_id');
    }


}
