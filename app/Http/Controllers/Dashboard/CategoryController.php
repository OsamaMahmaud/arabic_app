<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\updateCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $categories=category::when($request->search,function($q)use($request){
            return $q->whereTranslationLike("name","like","%{$request->search}%");
        })->latest()->paginate(5);
        return view("dashboard.category.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("dashboard.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        // dd($request->all());
        $requestData = $request->all();
       $cat=  category::create($requestData);


        //   dd($request->all());
          return redirect()->route("dashboard.categories.index")->with("success",__("site.added_successfully"));

    //     return $cat;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view("dashboard.category.edit",compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateCategoryRequest $request, string $id)
    {
        $category=category::find($id);
        $category->update($request->all());
        return redirect()->route("dashboard.categories.index")->with("success",__("site.updated_successfully"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete();

         return redirect()->route("dashboard.categories.index")->with("success",__("site.deleted_successfully"));
    }
}
