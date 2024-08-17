<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.single-pages.category',[
            'categories' => Category::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name);
        $category->save();
        $request->session()->flash('success', 'Category created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name);
        $category->save();
        $request->session()->flash('success', 'Category edited successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Category $category)
    {
        $category->delete();
        $subcategory = SubCategory::where('category_id', $category->id)->get();
        $subcategory->delete();
        $request->session()->flash('success', 'Category deleted successfully!');
        return back();      
    }
}
