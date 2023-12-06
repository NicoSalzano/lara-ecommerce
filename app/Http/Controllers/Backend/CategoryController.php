<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.category.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required','max:200','unique:categories,name'],
            // 'slug' => ['required','max:200'],
            'icon' =>['required','not_in:empty'],
            'status' =>['required']
        ]);

        $category = Category::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'status' => $request->status,
            'slug' => Str::slug($request->name)
        ]);

        return redirect(route('admin.category.index'))->with('message', 'La categria e stata creata');
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
        $category = Category::findOrFail($id);
        return view('Admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required','max:200','unique:categories,name,'.$id],
            // 'slug' => ['required','max:200'],
            'icon' =>['required','not_in:empty'],
            'status' =>['required']
        ]);


        $category = Category::findOrFail($id)->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'status' => $request->status,
            'slug' => Str::slug($request->name)
        ]);

        return redirect(route('admin.category.index'))->with('message','La categoria e stata modificata.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $subCategory = SubCategory::where('category_id',$category->id)->count();
        if ($subCategory > 0) {
            return response(['status' => 'error', 'message' => 'la categoria non puo essere eliminata']);
        }
        $category->delete();
        return response(['status' => 'success', 'message' => 'la categoria e stata  eliminata']);

        
    }

    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true'? 1 : 0;
        $category->save();

        return response(['message' => 'Stato modificato']);
    }


}
