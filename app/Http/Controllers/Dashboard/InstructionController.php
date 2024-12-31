<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructions=Instruction::paginate(5);
        return view('dashboard.instructions.index',compact('instructions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //validation
        return view('dashboard.instructions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            ]);

            //craete
            Instruction::create([
                'title'=>$request->title,
                'content'=>$request->content,
                ]);
             
        return redirect()->route('dashboard.instructions.index')->with('success',__('site.added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $instruction=Instruction::find($id);
        return view('dashboard.instructions.edit',compact('instruction'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validation
        $request->validate([
            'title'=>'required|string',
            'content'=>'required|string',
            ]);


        $instruction=Instruction::find($id);
        $instruction->update([
            'title'=>$request->title,
            'content'=>$request->content,
            ]);
            return redirect()->route('dashboard.instructions.index')->with('success',__('site.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instructions=Instruction::findOrFail($id);
        $instructions->delete();
        return redirect()->route('dashboard.instructions.index')->with('success',__('site.deleted_successfully'));
    }
}
