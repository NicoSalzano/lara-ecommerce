<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\backend\ChildCategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Models\SubCategory;

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