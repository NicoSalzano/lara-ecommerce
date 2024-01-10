<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProductVariantDataTable;
use App\Models\ProductVariant;

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
            'name.*' =>['required', 'max:50'],
            'status.*' => 'required',
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
}
