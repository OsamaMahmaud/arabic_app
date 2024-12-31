<?php

namespace App\Http\Controllers\Dashboard\Levels;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        $levels = Level::withCount('videos')->when($request->search, function ($q) use ($request) {
            return $q->where("name", "like", "%{$request->search}%");
        })->paginate(5);
        return view('dashboard.levels.index',compact('levels'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('dashboard.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation 
        $request->validate([
            'name' => 'required|string|unique:levels',
            ]);
            //store
            Level::create($request->all());
            return redirect()->route('dashboard.levels.index')->with('success',__('site.added_successfully'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $level = Level::find($id);
        return view('dashboard.levels.edit',compact('level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        //validation
        $request->validate([
            'name' => 'required|unique:levels,name,'.$id,
            ]);
            //update
            Level::find($id)->update($request->all());
            return redirect()->route('dashboard.levels.index')->with('success',__('site.updated_successfully'));

            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        Level::destroy($id);
        return redirect()->route('dashboard.levels.index')->with('success',__('site.deleted_successfully'));
    }
}
