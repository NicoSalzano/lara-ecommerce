<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProfileController;

// Admin routes 
Route::get('dashboard',[AdminController::class, 'dashboard'])->name('dashboard');

// profile route
Route::get('profile',[ProfileController::class, 'index'])->name('profile');
Route::post('profile/update',[ProfileController::class, 'update'])->name('profile.update');

// update password route

Route::post('profile/update/password',[ProfileController::class, 'updatePassword'])->name('password.update');

// Slider routes
Route::resource('slider',SliderController::class);
