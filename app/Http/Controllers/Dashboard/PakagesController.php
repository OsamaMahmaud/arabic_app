<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PakagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pakages=Package::paginate(5);
        return view('dashboard.pakages.index',compact('pakages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.pakages.create');    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
           'description' => 'required|string',]);

           Package::create($request->all());

           return redirect()->route('dashboard.pakages.index')->with('success',__('site.added_successfully'));

    }

 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $package=Package::find($id);
        return view('dashboard.pakages.edit',compact('package'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $package=Package::find($id);
        
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',]);

            $package->update($request->all());
            return redirect()->route('dashboard.pakages.index')->with('success',__('site.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
