<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * التخصيص الخاص بمُعالج الاستثناءات.
     */
    public function render($request, Throwable $exception)
    {
        // معالجة استثناءات التحقق من الصحة
        if ($exception instanceof ValidationException) {
            // استخراج الأخطاء
            $message = $exception->errors();
            // الحصول على أول رسالة خطأ
            $firstMessage = reset($message)['0'] ?? 'هناك أخطاء في المدخلات.';

            // إرجاع الرسالة فقط بدون تفاصيل الأخطاء
            return response()->json([
                'message' => $firstMessage,
            ], 422);
        }

        // في حال لم يكن الاستثناء من النوع ValidationException، استخدم المعالج الافتراضي
        return parent::render($request, $exception);
    }

    /**
     * قائمة المدخلات التي لا يجب نقلها إلى الجلسة في استثناءات التحقق.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * تسجيل الاستثناءات المعالجة للتطبيق.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // التعامل مع الاستثناءات حسب الحاجة
        });
    }
}
