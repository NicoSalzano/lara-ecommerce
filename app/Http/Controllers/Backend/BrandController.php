<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Str;

class BrandController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
       return $dataTable->render('Admin.Brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'logo'=> ['image','required', 'max:2000'],
            'name'=> ['required', 'max:200'],
            'featured'=> ['required'],
            'status'=> ['required'],
        ]);

        $logoPath = $this->uploadImage($request, 'logo', 'uploads');
        
        $brand = Brand::create([
            'logo'=> $logoPath,
            'name'=> $request->name,
            'status'=> $request->status,
            'featured'=> $request->featured,
            'slug' => Str::slug($request->name)
        ]);

        return redirect(route('admin.brand.index'))->with('message', 'Successfully');
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
        $brands = Brand::findOrFail($id);
        return view('Admin.Brand.edit', compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'logo'=> ['nullable','image', 'max:2000'],
            'name'=> ['required', 'max:200'],
            'featured'=> ['required'],
            'status'=> ['required'],
        ]);

        $brand = Brand::findOrFail($id);
        $logoPath = $this->updateImage($request, 'logo','uploads', $brand->logo);

        $brand->logo = empty(!$logoPath) ? $logoPath : $brand->logo;
        $brand->name = $request->name;
        $brand->featured = $request->featured;
        $brand->status = $request->status;
        $brand->save();

        return redirect(route('admin.brand.index'))->with('message', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $this->deleteImage($brand->logo);
        $brand->delete();
        return response(['status' => 'success', 'message' => 'Brand deleted']);
    }

    public function changeStatus(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status == 'true'? 1 : 0;
        $brand->save();

        return response(['message' => 'Stato modificato']);
    }

    // public function changeFeature(Request $request)
    // {
    //     $brand = Brand::findOrFail($request->id);
    //     $brand->featured = $request->featured == 'true'? 1 : 0;
    //     $brand->save();

    //     return response(['message' => 'Stato modificato']);
    // }
}
