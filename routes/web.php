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

// show all listings
Route::get('/', [ListingController::class, 'index']);

// show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// store a new listing
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// update a listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// delete a listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// show manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// show a single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

/************************* USER ROUTES ***************************/

// show registration form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// store a new user
Route::post('/users', [UserController::class, 'store'])->middleware('guest');

// logout the user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// authenticate the user
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');
