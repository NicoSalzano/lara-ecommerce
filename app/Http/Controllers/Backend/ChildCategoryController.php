<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {   
       return $dataTable->render('admin.child-category.index'); 
    }

   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $categories = Category::all();
        return view('Admin.child-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],
            'name' => ['required', 'max:200', 'unique:child_categories,name'],
            'status' => ['required']
        ]);

        // $childCategory = new ChildCategory();

        // $childCategory->category_id = $request->category;
        // $childCategory->sub_category_id = $request->sub_category;
        // $childCategory->name = $request->name;
        // $childCategory->status = $request->status;
        // $childCategory->slug = Str::slug($request->name);
        // $childCategory->save();

        $childCategory = ChildCategory::create([
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'name' => $request->name,
            'status' =>$request->status,
            'slug' => Str::slug($request->name),
        ]);

        return redirect(route('admin.child-category.index'))->with('message', 'Child Category creaat');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // get subcategories
    public function getSubCategories(Request $request)
    {
        // return $request->all();
        $subCategories = SubCategory::where('category_id', $request->id)->where('status',1)->get();
        return $subCategories;
    }
}
