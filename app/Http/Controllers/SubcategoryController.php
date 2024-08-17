<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::paginate(10);
        return view('backend.single-pages.subcategory',[
            'subcategories' => $subcategories,
            'categories' => Category::all()
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
        $subcategory = new SubCategory;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_slug = Str::slug($request->subcategory_name);
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        $request->session()->flash('success', 'Sub Category created successfully!');
        return back();
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_slug = Str::slug($request->subcategory_name);
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        $request->session()->flash('success', 'Sub Category edited successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
