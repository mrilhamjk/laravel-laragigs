<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
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

// Show All Listings
Route::get('/', [
    ListingController::class, 'index'
]);

// Show Create Form
Route::get('/listings/create', [
    ListingController::class, 'create'
])->middleware('auth');

// Store Listing Data
Route::post('/listings', [
    ListingController::class, 'store'
])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [
    ListingController::class, 'edit'
])->where('listing', '[0-9]+')->middleware('auth');

// Update Listing Data
Route::put('/listings/{listing}', [
    ListingController::class, 'update'
])->where('listing', '[0-9]+')->middleware('auth');

// Delete Listing Data
Route::delete('/listings/{listing}', [
    ListingController::class, 'destroy'
])->where('listing', '[0-9]+')->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [
    ListingController::class, 'manage'
])->middleware('auth');

// Show Single Listing
Route::get('/listings/{listing}', [
    ListingController::class, 'show'
])->where('listing', '[0-9]+');

// Show Register Create Form
Route::get('/register', [
    UserController::class, 'getregister'
])->middleware('guest')->name('register');

// Show Login Create Form
Route::get('/login', [
    UserController::class, 'getlogin'
])->middleware('guest')->name('login');

// Register User
Route::post('/register', [
    UserController::class, 'register'
])->middleware('guest');

// Login User
Route::post('/login', [
    UserController::class, 'login'
])->middleware('guest');

// Logout User
Route::post('/logout', [
    UserController::class, 'logout'
])->middleware('auth');
