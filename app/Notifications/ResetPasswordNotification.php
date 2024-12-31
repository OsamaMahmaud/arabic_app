<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $message;
    public $subject;
    public $fromEmail;
    private $otp;

    /**
     * إنشاء نسخة جديدة من الإشعار.
     */
    public function __construct()
    {
        $this->otp = new Otp(); // تهيئة كائن OTP
        $this->message = "استخدم الكود أدناه لإعادة تعيين كلمة المرور الخاصة بك";
        $this->subject = "طلب إعادة تعيين كلمة المرور";
        $this->fromEmail = "arabic@gmail.com";
    }

    /**
     * تحديد قنوات تسليم الإشعار.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * الحصول على التمثيل البريدي للإشعار.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // توليد OTP
        $otp = $this->otp->generate($notifiable->email, 'numeric', 6, 15); // معلمات: البريد الإلكتروني، طول OTP، ومدة الصلاحية (بالثواني)
        $otpToken = $otp->token; // الحصول على الرمز المولد

        return (new MailMessage)
            ->subject($this->subject)
            ->from($this->fromEmail)
            ->greeting('مرحبًا ' . $notifiable->first_name)
            ->line($this->message)
            ->line('الكود: ' . $otpToken);
    
    }

//     public function toMail(object $notifiable): MailMessage
//    {
//         $otp = $this->otp->generate($notifiable->email, 'numeric', 6, 15);
//         $otpToken = $otp->token;

//         return (new MailMessage)
//             ->subject($this->subject)
//             ->from($this->fromEmail)
//             ->greeting('مرحبًا')
//             ->line('استخدم الكود أدناه لإعادة تعيين كلمة المرور الخاصة بك')
//             ->line('الكود الخاص بك هو:')
//             ->line($otpToken)
//             ->line('هذا الرمز صالح لمدة 15 دقيقة.')
//             ->line('إذا لم تقم بطلب إعادة تعيين كلمة المرور، يرجى تجاهل هذه الرسالة.')
//             ->salutation('مع تحيات فريق الدعم.');
//     }


    /**
     * الحصول على التمثيل في شكل مصفوفة للإشعار.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
