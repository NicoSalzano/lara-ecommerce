<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('Admin.SubCategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Admin.subCategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'category' =>['required'],
            'name' => ['required','max:200','unique:sub_categories,name'],
            'status' =>['required']
        ]);

        // CAPIRE ERRORE NEL MASS ASSIGNEMENTS
        // $subCategory = SubCategory::create([
        //     'name' => $request->name,
        //     'status' => $request->status,
        //     'category_id' => $request->category,
        //     'slug' => Str::slug($request->name)
        // ]);

        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category;
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->status = $request->status;
        $subCategory->save();

        return redirect(route('admin.sub-category.index'))->with('message', 'subcategoria creata');
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
        $categories = Category::all();
        $subCategories = SubCategory::findOrFail($id);
        return view('Admin.subCategory.edit', compact('subCategories', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' =>['required'],
            'name' => ['required','max:200','unique:sub_categories,name,'.$id],
            'status' =>['required']
        ]);

        // $subCategory = SubCategory::findOrFail($id);
        // $subCategory->category_id = $request->category;
        // $subCategory->name = $request->name;
        // $subCategory->slug = Str::slug($request->name);
        // $subCategory->status = $request->status;
        // $subCategory->save();

        $subCategories = SubCategory::findOrFail($id)->update([
            'name' => $request->name,
            'status' => $request->status,
            'category_id' => $request->category,
            'slug' => Str::slug($request->name)
        ]);

        return redirect(route('admin.sub-category.index'))->with('message', 'subcategoria modificata');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id)->delete();
        return response(['status' => 'success', 'delete sub-category']);
    }

    public function changeStatus(Request $request)
    {
        $subCategory = SubCategory::findOrFail($request->id);
        $subCategory->status = $request->status == 'true'? 1 : 0;
        $subCategory->save();

        return response(['message' => 'Stato modificato']);
    }

}
