<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProductVariantDataTable;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductVariantDataTable $dataTable , Request $request)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('Admin.Product.product-variant.index',compact('product') );
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request)
    // {
    //     $products = Product::findOrFail($request->product);
    //     return view('Admin.Product.product-variant.create', compact('products'));
    // }
    public function create()
    {
        return view('Admin.Product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' =>['required', 'max:50'],
            'status' => 'required',
            'product' => ['required', 'integer']
        ]);

        // $names = $request->name;
        // $statuses = $request->status;
        // $product_id = $request->product;
        // foreach ($names as $key => $name) {
        //     ProductVariant::create([
        //         'name' => $name,
        //         'status' => $statuses[$key],
        //         'product' => $product_id
        //     ]);
        // }

        $variant = new ProductVariant();
        $variant->product_id = $request->product;
        $variant->status = $request->status;
        $variant->name = $request->name;
        $variant->save();

        // return redirect()->route('Admin.Product.product-variant.index')->with('message', 'Successfully created');
        return redirect(route('admin.products-variant.index',['product'=>$request->product]))->with('message', 'Successfully created');
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
        $variant = ProductVariant::findOrFail($id);
        return view('Admin.Product.product-variant.edit', compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'name' =>['required', 'max:50'],
            'status' => 'required',
        ]);

        $variant = ProductVariant::findOrFail($id);
        $variant->name = $request->name;
        $variant->status = $request->status;
        $variant->save();

        return redirect(route('admin.products-variant.index',['product'=>$variant->product_id]))->with('message', 'Successfully modified product');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variantItemCheck = ProductVariantItem::where('product_variant_id',$variant->id)->count();
        if ($variantItemCheck) {
        return response(['status' => 'error', 'message' => 'delete item variant first']);
            
        } 
        $variant->delete();
        return response(['status' => 'success', 'message' => 'NICOLA']);
    }
    // public function destroy(string $id)
    // {
    //     $brand = Brand::findOrFail($id);
    //     $this->deleteImage($brand->logo);
    //     $brand->delete();
    //     return response(['status' => 'success', 'message' => 'Brand deleted']);
    // }

    /**
     * Change the status of the data.
     */
    public function changeStatus(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->id);
        $variant->status = $request->status == 'true' ? 1 : 0;
        $variant->save();
        return response(['message' => 'Stato modificato']);

    }
    // public function changeStatus(Request $request)
    // {
    //     $brand = Brand::findOrFail($request->id);
    //     $brand->status = $request->status == 'true'? 1 : 0;
    //     $brand->save();

    //     return response(['message' => 'Stato modificato']);
    // }
}
