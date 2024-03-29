<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;

//Vendor routes
Route::get('dashboard',[VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile',[VendorProfileController::class, 'index'])->name('profile');

Route::post('profile/update',[VendorProfileController::class, 'update'])->name('profile.update');

// update password route

Route::post('profile/update/password',[VendorProfileController::class, 'updatePassword'])->name('password.update');

// shop vendor profile

Route::resource('shop-profile', VendorShopProfileController::class);

// product routes

Route::resource('products', VendorProductController::class);