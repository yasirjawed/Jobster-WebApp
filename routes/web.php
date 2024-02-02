<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

// For fetching all listings
Route::get('/',[ListingController::class,'index']);

// Show create form
Route::get('posts/create',[ListingController::class,'create'])->middleware('auth');

// For storing the listings
Route::post('/listings',[ListingController::class,'store'])->middleware('auth');

// Show Edit Form
Route::get('posts/{Listing}/edit',[ListingController::class,'edit'])->middleware('auth');

// For Update the listings
Route::put('/listings/{Listing}',[ListingController::class,'update'])->middleware('auth');

// For Delete the listings
Route::delete('/listings/{Listing}',[ListingController::class,'destroy'])->middleware('auth');

// Show login form
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');

// For fetching single listings
Route::get('posts/{listing}',[ListingController::class,'show']);

// Show register form
Route::get('/register',[UserController::class,'create'])->middleware('guest');

// Show login form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

// Login User
Route::post('/user/authenticate',[UserController::class,'authenticate'])->middleware('guest');

// Socialite Login User
Route::get('googleLogin',[UserController::class,'googleLogin'])->middleware('guest');

// Socialite Login User
Route::get('/auth/google/callback',[UserController::class,'googleHandle'])->middleware('guest');

// Create New User
Route::post('/users',[UserController::class,'store'])->middleware('guest');

// Logout user
Route::post('/logout',[UserController::class,'logout']);