<?php

namespace App\Http\Controllers\Dashboard\Videos;

use App\Models\Level;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(  Request $request)
    {
        $levels = Level::get();
        $sections=Video::get('section_name');

        $contants=Video::when( $request->section_name,function($q)use($request)
        {
            $q->where('section_name',$request->section_name);
        })->when($request->level,function($q)use($request){
            $q->where('level_id',$request->level);
        })->paginate(5);
        return view('dashboard.videos.index',compact('contants','sections','levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels=Level::get();

        $categories=Video::get('section_name');
        
        return view('dashboard.videos.create',compact('levels','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $description = strip_tags($request->description);


        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'section_name' => 'required|string',
            'level_id' => 'required|integer',
            'url' => 'required|mimes:mp4,webm,ogg,avi,mov|max:20480',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // إنشاء الفيديو بدون الصورة والفيديو
        // $video = Video::create($request->except(['image', 'url']));
        $video = Video::create([
            'title' => $request->title,
            'description' => $description,  // استخدام الوصف المعدل
            'section_name' => $request->section_name,
            'level_id' => $request->level_id,
           
        ]);
    
        // رفع الصورة
        if ($request->hasFile('image')) {
            $media = $video->addMediaFromRequest('image')
                ->usingFileName($request->section_name . '_image.' . $request->file('image')->getClientOriginalExtension())
                ->toMediaCollection('video_image');
            
            // تخزين مسار الصورة في قاعدة البيانات
            $video->image = $media->getUrl();
            $video->save();
        }
    
        // رفع الفيديو
        if ($request->hasFile('url')) {
            $media = $video->addMediaFromRequest('url')
                ->usingFileName($request->section_name . '_video.' . $request->file('url')->getClientOriginalExtension())
                ->toMediaCollection('video_url');
            
            // تخزين مسار الفيديو في قاعدة البيانات
            $video->url = $media->getUrl();
            $video->save();
        }
    
        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('dashboard.videos.index')->with('success', __('site.added_successfully'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $video = Video::find($id);
        $levels = Level::all();
        $categories=Video::get('section_name');
        return view('dashboard.videos.edit', compact('video', 'levels', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        // إزالة العلامات من الوصف
        $description = strip_tags($request->description);
    
        // تحقق من البيانات المرسلة
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'section_name' => 'required|string',
            'level_id' => 'required|integer',
            'url' => 'nullable|mimes:mp4,webm,ogg,avi,mov|max:20480',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // تحديث البيانات الأساسية للفيديو
        $video->update([
            'title' => $request->title,
            'description' => $description, // استخدام الوصف المعدل
            'section_name' => $request->section_name,
            'level_id' => $request->level_id,
        ]);
    
        // تحديث الصورة إذا تم إرسالها
        if ($request->hasFile('image')) {
            // حذف الصورة الحالية من مكتبة الوسائط
            $video->clearMediaCollection('video_image');
    
            // رفع الصورة الجديدة
            $media = $video->addMediaFromRequest('image')
                ->usingFileName($request->section_name . '_image.' . $request->file('image')->getClientOriginalExtension())
                ->toMediaCollection('video_image');
    
            // تخزين مسار الصورة في قاعدة البيانات
            $video->image = $media->getUrl();
            $video->save();
        }
    
        // تحديث الفيديو إذا تم إرساله
        if ($request->hasFile('url')) {
            // حذف الفيديو الحالي من مكتبة الوسائط
            $video->clearMediaCollection('video_url');
    
            // رفع الفيديو الجديد
            $media = $video->addMediaFromRequest('url')
                ->usingFileName($request->section_name . '_video.' . $request->file('url')->getClientOriginalExtension())
                ->toMediaCollection('video_url');
    
            // تخزين مسار الفيديو في قاعدة البيانات
            $video->url = $media->getUrl();
            $video->save();
        }
    
        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('dashboard.videos.index')->with('success', __('site.updated_successfully'));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        // تحديد الفيديو المراد حذفها
        $video = Video::find($id);
        
        try {
            // حذف جميع الوسائط المرتبطة بالفيديو
            $video->clearMediaCollection('video_image');
            $video->clearMediaCollection('video_url');
    
            // حذف الفيديو من قاعدة البيانات
            $video->delete();
    
            // إعادة التوجيه مع رسالة نجاح
            return redirect()->route('dashboard.videos.index')->with('success', __('site.deleted_successfully'));
        } catch (\Exception $e) {
            // إعادة التوجيه مع رسالة خطأ في حالة حدوث مشكلة
            return redirect()->route('dashboard.videos.index')->with('message', 'delete_failed');
        }



    }
}