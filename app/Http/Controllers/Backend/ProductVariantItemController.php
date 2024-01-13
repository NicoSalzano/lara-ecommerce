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
    public function edit(string $variantItemId)
    {
        $variant = ProductVariantItem::findOrFail($variantItemId);
        return view('Admin.Product.product-variant-item.edit', compact('variant'));
    }

    public function update(Request $request, string $variantItemId)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required','max:200'],
            'is_default' => ['integer', 'required'],
            'is_default' => 'required',
            'status' => 'required',
        ]);
        $productItems = ProductVariantItem::findOrFail($variantItemId);

        $productItems->name = $request->name;
        $productItems->price = $request->price;
        $productItems->status = $request->status;
        $productItems->is_default = $request->is_default;
        $productItems->save();
        
        // nel caso del productId acceddo alla relazione fatta  nel modello per poter recuperare il productId
        return redirect(route('admin.products-variant-item.index', ['productId'=>$productItems->productVariant->product_id, 'variantId' =>$productItems->product_variant_id]))->with('message','item modificato');
    }

    public function destroy(string $variantItemId)
    {
        $variant = ProductVariantItem::findOrFail($variantItemId);
        $variant->delete();
        return response(['status' => 'success', 'message' => 'Item eliminato']);

    }
    public function changeStatus(Request $request)
    {
        $variant = ProductVariantItem::findOrFail($request->id);
        $variant->status = $request->status == 'true' ? 1 : 0;
        $variant->save();
        return response(['message' => 'Stato modificato']);

    }

    

}
