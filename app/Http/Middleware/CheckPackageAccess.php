<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPackageAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user()->load('levels'); // تحميل العلاقة مع المستويات

        // التحقق من وجود مستويات
        if (!$user->levels || $user->levels->isEmpty()) {
            return response()->json(['error' => 'No accessible levels for this user'], 403);
        }

        // جلب IDs المستويات المسموح بها
        $accessibleLevels = $user->levels->pluck('id')->toArray();

        // تعديل الطلب لإضافة المستويات
        $request->merge(['accessibleLevels' => $accessibleLevels]);

        return $next($request);
    }
}
