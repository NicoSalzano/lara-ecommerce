<?php

use App\Models\SubCategory;
use App\Models\ProductVariant;
use App\Models\ProductImageGallery;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProductImageGalleryController;

// Admin routes 
Route::get('dashboard',[AdminController::class, 'dashboard'])->name('dashboard');

// profile route
Route::get('profile',[ProfileController::class, 'index'])->name('profile');
Route::post('profile/update',[ProfileController::class, 'update'])->name('profile.update');

// update password route

Route::post('profile/update/password',[ProfileController::class, 'updatePassword'])->name('password.update');

// Slider routes
Route::resource('slider',SliderController::class);

// category routes
Route::put('change-status',[CategoryController::class, 'changeStatus'])->name('change-status');
Route::resource('category',CategoryController::class);

// subcategory routes
Route::put('subcategory/change-status',[SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category',SubCategoryController::class);

// child-category routes
Route::put('childcategory/change-status',[ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories',[ChildCategoryController::class ,'getSubCategories'])->name('get-subcategories');
Route::resource('child-category',ChildCategoryController::class);

// brand routes
Route::put('brand/change-status',[BrandController::class, 'changeStatus'])->name('brand.change-status');
// Route::put('brand/change-feature',[BrandController::class, 'changeFeature'])->name('brand.change-features');
Route::resource('brand',BrandController::class);

// vendor profile route
Route::resource('vendor-profile', AdminProfileController::class);

// product route
Route::put('product/change-status',[ProductController::class, 'changeStatus'])->name('product.change-status');
Route::get('product/get-subcategory',[ProductController::class, 'getSubCategory'])->name('product.get-subcategories');
Route::get('product/get-childcategory',[ProductController::class, 'getChildCategory'])->name('product.get-childcategories');
Route::resource('products', ProductController::class);

// product image route
Route::resource('products-image-gallery',ProductImageGalleryController ::class);

// Product variant
Route::put('products-variant/change-status',[ProductVariantController::class,'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);

// Product variant items
// Route::resource('products-variant-item', ProductVariantItemController::class);
Route::get('products-variant-item/{productId}/{variantId}',[ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}',[ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item',[ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::get('products-variant-item/{id}/edit',[ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');

Route::delete('products-variant-item/{id}',[ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
