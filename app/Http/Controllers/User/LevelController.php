<?php

namespace App\Http\Controllers\User;

use App\Models\Level;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\LevelResource;

class LevelController extends Controller
{
    use ApiTrait;
    
    // public function index()
    // {
    //     $levels =Level::withCount('videos')->get();

    //     $levels= LevelResource::collection($levels);

    //     return $this->SuccessMessage('Get All levels Successfully',200,$levels);

    // }

  //   public function index(Request $request)
  //  {
  //    try{

  //         $accessibleLevels = $request->input('accessibleLevels'); // المستويات المسموح بها

  //         // جلب المستويات المسموح بها فقط
  //         $levels = Level::whereIn('id', $accessibleLevels)->withCount('videos')->get();
  
  //         $levels = LevelResource::collection($levels);
  //         if(empty($levels))
  //         {
  //           return $this->SuccessMessage('No levels found',200,$levels);
  //         }
  
  //         return $this->SuccessMessage('Get Accessible Levels Successfully', 200, $levels);

  //    }
  //    catch(\Exception $e)
  //    {
  //         return $this->ErrorMessage('Error in getting levels', 500, $e->getMessage());
  //    }
       
  //  }



  public function index(Request $request)
{
    try {
        // جلب المعرفات الخاصة بالباقة المختارة
        $packageId = $request->input('package_id'); // مثلا: المعرف الخاص بالباقة
        $accessibleLevels = $request->input('accessibleLevels'); // المعرفات للمستويات التي ينتمي إليها الطالب

        // التحقق من أن المعرفات ليست فارغة
        if (empty($accessibleLevels)) {
            return $this->SuccessMessage('No levels provided', 200, []);
        }

        // جلب المستويات التي تنتمي إلى الباقة المختارة
        $levelsInPackage = Level::whereIn('id', $accessibleLevels)
            ->withCount('videos') // حساب عدد الفيديوهات في كل مستوى
            ->get();

        // جلب المستويات التي لا تنتمي إلى الباقة (المستويات التي لم يتم اختيارها في الباقة)
        $levelsNotInPackage = Level::whereNotIn('id', $accessibleLevels)
            ->withCount('videos') // حساب عدد الفيديوهات في كل مستوى
            ->get();

        $responseLevels = [];

        // إضافة المستويات الموجودة في الباقة للمستخدم
        foreach ($levelsInPackage as $level) {
            // حساب عدد الفيديوهات التي شاهدها المستخدم في هذا المستوى
            $viewedVideosCount = DB::table('user_video_views')
                ->where('user_id', $request->user()->id)
                ->whereIn('video_id', $level->videos->pluck('id')) // فيديوهات هذا المستوى
                ->count();

            // حساب نسبة التقدم
            $progress = $level->videos_count > 0
                ? round(($viewedVideosCount / $level->videos_count) * 100, 2)
                : 0;

            // إضافة النتيجة إلى الرد
            $responseLevels[] = [
                'level_id' => $level->id,
                'level_name' => $level->name,
                'total_videos' => $level->videos_count,
                'viewed_videos' => $viewedVideosCount,
                'progress' => "{$progress}%",
                'is_active' => true, // هذه المستويات مفعلة لأن الطالب ينتمي إليها
            ];
        }

        // إضافة المستويات التي لا تنتمي إلى الباقة، ولكن يتم عرضها كمستويات غير مفعلة
        foreach ($levelsNotInPackage as $level) {
            $responseLevels[] = [
                'level_id' => $level->id,
                'level_name' => $level->name,
                'total_videos' => $level->videos_count,
                'viewed_videos' => 0, // لا توجد فيديوهات مشاهد لها
                'progress' => '0%',
                'is_active' => false, // هذه المستويات غير مفعلة لأن الطالب لا ينتمي إليها
            ];
        }

        // التحقق من النتائج
        if (empty($responseLevels)) {
            return $this->SuccessMessage('No levels found', 200, $responseLevels);
        }

        return $this->SuccessMessage('Get Levels Successfully', 200, $responseLevels);
    } catch (\Exception $e) {
        return $this->ErrorMessage('Error in getting levels', 500, $e->getMessage());
    }
}

  


}
