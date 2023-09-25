<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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

// Home Page (index)
Route::get('/', [ProductController::class, 'index']);

// Users

// Show login form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');
// Show register form
Route::get('/register',[UserController::class,'register'])->middleware('guest');
// Create new user
Route::post('/users', [UserController::class,'store']);
// Logout user
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');
// Login user
Route::post('/users/authenticate',[UserController::class,'authenticate']);

// Products

// Manage Products
Route::get('/products/manage',[ProductController::class,'manage'])->middleware('auth');
// Show create form
Route::get('/products/create', [ProductController::class,'create'])->middleware('auth');
// Store Product data
Route::post('/products', [ProductController::class,'store'])->middleware('auth');
// Show edit form
Route::get('/products/{product}/edit',[ProductController::class,'edit'])->middleware('auth');
// Update Product
Route::put('/products/{product}',[ProductController::class,'update'])->middleware('auth');
// Delete Product
Route::delete('/products/{product}',[ProductController::class,'destroy'])->middleware('auth');