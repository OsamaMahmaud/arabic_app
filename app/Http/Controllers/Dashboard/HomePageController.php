<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Http\Requests\Dashboard\SliderUpdateRequest;

class HomePageController extends Controller
{
    public const AVAILABLE_EXTENSIONS = ['png', 'jpg', 'jpeg'];

    public function index(Request $request)
    {
        $sliders = Slider::when($request->search, function ($q) use ($request) {
            return $q->where("title", "like", "%{$request->search}%");
        })->latest()->paginate(5);

        return view('dashboard.homepage.index', compact('sliders'));
    }

    public function create()
    {
        return view("dashboard.homepage.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $slider = Slider::create($request->safe()->except('image_path'));
        if ($request->hasFile('image_path')) {
            $media = $slider->addMediaFromRequest('image_path')
                ->usingFileName($request->title . '_image.' . $request->file('image_path')->getClientOriginalExtension())
                ->toMediaCollection('slider_images'); // Store new image

            // Save the media path to the database
            $slider->image_path = $media->getUrl(); // Get the public URL of the media file
            $slider->save(); // Save the updated slider record
        }


        return redirect()->route('dashboard.homepage.index')->with('success', 'Slider created successfully');
    }

    public function edit( $id)
    {
        $slider = Slider::find($id);
        return view("dashboard.homepage.edit",compact("slider"));
    }

    //update
    public function update(SliderUpdateRequest $request, $id)
    {
        $slider = Slider::find($id);
        $slider->update($request->safe()->except('image_path'));
        if ($request->hasFile('image_path'))
         {

            $slider->clearMediaCollection('image_path');

            $media = $slider->addMediaFromRequest('image_path')
            ->usingFileName($request->title . '_image.' . $request->file('image_path'
            )->getClientOriginalExtension())
            ->toMediaCollection('slider_images'); // Store new image
            // Save the media path to the database
            $slider->image_path = $media->getUrl(); // Get the public URL of the media
            
            $slider->save(); // Save the updated slider record
         }
         else
         {
            return"notfound";
         }

            return redirect()->route('dashboard.homepage.index')->with('success', 'Slider updated successfully');
    }




    public function destroy($id)
    {

        $slider = Slider::find($id);
        if ($slider) {
            $slider->delete();
            return redirect()->route("dashboard.homepage.index")->with("success", __("site.deleted_successfully"));
        } else {
            return redirect()->route("dashboard.homepage.index")->with("error", __("site.not_found"));
        }

    }

}