<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\IntroVideo;
use Illuminate\Http\Request;

class Video_HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos=IntroVideo::latest()->get();
        return view('dashboard.homepage.video_home.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('dashboard.homepage.video_home.create');
    }

    public function store(Request $request)
    {
        // تحقق من صحة البيانات
        $request->validate([
            'video_url' => 'required|mimes:mp4,avi,mov|max:20480', // 20MB
        ]);

        // dd($request->video_url);

        try {
            $video = IntroVideo::create(['video_url' => '']); // قيمة مؤقتة
        
            $media = $video->addMedia($request->file('video_url')->getRealPath())
                ->usingFileName(uniqid() . '.' . $request->file('video_url')->getClientOriginalExtension())
                ->toMediaCollection('intro_video');
        
            // تحديث مسار الفيديو بعد رفعه
            $video->video_url = $media->getUrl();
            $video->save();
        
            return redirect()->route('dashboard.videohome.index')
                ->with('success', __('site.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['video_url' => 'Error uploading video: ' . $e->getMessage()]);
        }
    }        

    public function edit( $id)
    {
         $video =IntroVideo::findOrFail($id);
        return view('dashboard.homepage.video_home.edit', compact('video'));
    }


    public function update(Request $request, $id)
{
    // تحقق من صحة البيانات
    $request->validate([
        'video_url' => 'nullable|mimes:mp4,avi,mov|max:20480', // الفيديو اختياري
    ]);

    try {
        // جلب الفيديو المطلوب
        $video = IntroVideo::findOrFail($id);

        // إذا تم رفع فيديو جديد
        if ($request->hasFile('video_url')) {
            // حذف الفيديو القديم من المجموعة
            $video->clearMediaCollection('intro_video');

            // رفع الفيديو الجديد
            $media = $video->addMedia($request->file('video_url')->getRealPath())
                ->usingFileName(uniqid() . '.' . $request->file('video_url')->getClientOriginalExtension())
                ->toMediaCollection('intro_video');

            // تحديث مسار الفيديو في قاعدة البيانات
            $video->video_url = $media->getUrl();
        }

        // تحديث الفيديو
        $video->save();

        return redirect()->route('dashboard.videohome.index')
            ->with('success', __('site.updated_successfully'));
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['video_url' => 'Error updating video: ' . $e->getMessage()]);
    }
}

public function destroy( $id)
{
    $video =IntroVideo::findOrFail($id);
    $video->clearMediaCollection('intro_video');
    $video->delete();

    return redirect()->route('dashboard.videohome.index')
        ->with('success', __('site.deleted_successfully'));
}

    
}
