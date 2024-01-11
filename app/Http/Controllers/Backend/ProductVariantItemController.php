<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use App\DataTables\ProductVariantItemDataTable;
use App\Models\ProductVariantItem;

class ProductVariantItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId); 
        return $dataTable->render('Admin.Product.product-variant-item.index', compact('variant', 'product'));
    }

    public function create(string  $productId, string $variantId)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId); 
        
        // dd($id);
        return view('Admin.Product.product-variant-item.create', compact('variant', 'product'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'variant_id' => ['integer', 'required'],
            'name' => ['required','max:200'],
            'is_default' => ['integer', 'required'],
            'is_default' => 'required',
            'status' => 'required',
        ]);

        $productItems = new ProductVariantItem();
        $productItems->product_variant_id = $request->variant_id;
        $productItems->name = $request->name;
        $productItems->price = $request->price;
        $productItems->status = $request->status;
        $productItems->is_default = $request->is_default;
        $productItems->save();

        return redirect(route('admin.products-variant-item.index', ['productId'=>$request->product_id, 'variantId' =>$request->variant_id]))->with('message','item creato');
    }
    public function edit(string $id)
    {

    }
}
