<?php

namespace App\Http\Controllers\Backend;

use Str;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Traits\ImageUploadTrait;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.Product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // modificare all() perche i modelli hanno lo status quindi prendere solo quelli che hanno valore 1
        $categories = Category::all();
        $brands = Brand::all();
        return view('Admin.Product.create', compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // RISCRIVERLO IN MASS ASSIGNEMENT E AGGIUNGERE I CAMPI ALL INTERNO DEL MODELLO 
        $request->validate([
            'thumb_image' => ['required', 'max:2000','image'],
            'name' =>['required', 'max:100'],
            'category'=> 'required',
            'brand'=> 'required',
            'price'=>'required',
            'qty'=>'required',
            'short_description' =>['required', 'max:200'],
            'long_description' =>['required', 'max:2000'],
            'product_type' => 'required',
            'status'=> 'required',
            'seo_titles' => ['nullable','max:70'],
            'seo_description' => ['nullable', 'max:2000'],
        ]);


        $imagePath = $this->uploadImage($request, 'thumb_image', 'uploads');

        $product = new Product();

        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->vendor_id = Auth::user()->vendor->id;
        $product->is_approved = 1;
        $product->sku = $request->sku;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->video_link = $request->video_link;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->save();

        return redirect(route('admin.products.index'))->with('message', 'Success');



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
    
    /**
     * Get all products sub categories
     */
     public function getSubCategory(Request $request)
     {
        $subCategories = SubCategory::where('category_id', $request->id)->where('status',1)->get();
        return $subCategories;
     }

     /**
     * Get all products child categories
     */
     public function getChildCategory(Request $request)
     {
        $childCategory = ChildCategory::where('sub_category_id', $request->id)->where('status', 1)->get();
        return $childCategory;
     }
}
