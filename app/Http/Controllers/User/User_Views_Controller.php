<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class User_Views_Controller extends Controller
{
   
    public function markVideoAsViewed(Request $request)
   {
        // التحقق من البيانات
        $validatedData = $request->validate([
            'video_id' => 'required|exists:videos,id', // التحقق من أن الفيديو موجود في جدول الفيديوهات
        ]);

        // الحصول على المستخدم
        $userId = $request->user()->id;
        $videoId = $validatedData['video_id'];


          // الحصول على الفيديو مع اسم المستوى من جدول المستويات
        $video = DB::table('videos')
        ->join('levels', 'videos.level_id', '=', 'levels.id')
        ->where('videos.id', $videoId)
        ->select('videos.section_name', 'levels.name as level_name')
        ->first();


        // الحصول على اسم القسم من الفيديو
        // $video = DB::table('videos')->where('id', $videoId)->first();

        $sectionName = $video->section_name;
        $level_name=$video->level_name;

        // تحقق من أن المشاهدة لم تُسجل مسبقًا
        $existingView = DB::table('user_video_views')
            ->where('user_id', $userId)
            ->where('video_id', $videoId)
            ->first();

        if (!$existingView) {
            DB::table('user_video_views')->insert([
                'user_id' => $userId,
                'video_id' => $videoId,
                'section_name' => $sectionName,
                'level_name'=>$level_name,
                'viewed_at' => now(),
            ]);
        }

        return response()->json(['message' => 'Video marked as viewed'], 200);
    }



//     public function getAllLevelsProgress(Request $request)
// {
//     $userId = $request->user()->id;

//     // جلب جميع المستويات
//     $levels = DB::table('levels')->get();

//     // مصفوفة لتخزين التقدم في كل مستوى
//     $responseLevels = [];

//     foreach ($levels as $level) {
//         // جلب الأقسام والفيديوهات المرتبطة بالمستوى
//         $sections = DB::table('videos')
//             ->select('section_name', DB::raw('COUNT(id) as total_videos'))
//             ->where('level_id', $level->id)
//             ->groupBy('section_name')
//             ->get();

//         // مصفوفة لتخزين التقدم في كل قسم
//         $responseSections = [];
//         foreach ($sections as $section) {
//             // حساب عدد الفيديوهات التي تم مشاهدتها في القسم
//             $viewedVideosCount = DB::table('user_video_views')
//                 ->where('user_id', $userId)
//                 ->where('section_name', $section->section_name) // استخدام اسم القسم بدلاً من ID
//                 ->count();

//             // حساب نسبة التقدم في القسم
//             $progress = $section->total_videos > 0
//                 ? round(($viewedVideosCount / $section->total_videos) * 100, 2)
//                 : 0;

//             // إضافة التقدم إلى المصفوفة
//             $responseSections[] = [
//                 'section_name' => $section->section_name,
//                 'progress' => "{$progress}%",
//             ];
//         }

//         // إضافة المستوى مع الأقسام ونسب التقدم إلى المصفوفة النهائية
//         $responseLevels[] = [
//             'level_name' => $level->name,
//             'sections' => $responseSections,
//         ];
//     }

//     // إرجاع الاستجابة
//     return response()->json([
//         'levels' => $responseLevels,
//     ]);
// }


public function getAllLevelsProgress(Request $request)
{
    $userId = $request->user()->id;

    // جلب جميع المستويات المشحونة للمستخدم
    $shippedLevels = DB::table('level__users')
        ->where('user_id', $userId)
        ->get();

    $responseLevels = [];

    foreach ($shippedLevels as $userLevel) {
        // جلب الأقسام المشحونة في هذا المستوى
        $sections = DB::table('videos')
            ->select('section_name', DB::raw('COUNT(id) as total_videos'))
            ->where('level_id', $userLevel->level_id)
            ->groupBy('section_name')
            ->get();

        $responseSections = [];
        foreach ($sections as $section) {
            // حساب عدد الفيديوهات التي شاهدها المستخدم في القسم
            $viewedVideosCount = DB::table('user_video_views')
                ->where('user_id', $userId)
                ->where('section_name', $section->section_name)  // هنا نستخدم اسم القسم
                ->count();

            // حساب نسبة التقدم في القسم
            $progress = $section->total_videos > 0
                ? round(($viewedVideosCount / $section->total_videos) * 100, 2)
                : 0;

            $responseSections[] = [
                'section_name' => $section->section_name,
                'progress' => "{$progress}%",
            ];
        }

        $responseLevels[] = [
            'level_id' => $userLevel->level_id,
            'sections' => $responseSections,
        ];
    }

    return response()->json([
        'levels' => $responseLevels,
    ]);
}



}
