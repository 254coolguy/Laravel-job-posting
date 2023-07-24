<?php

use App\Models\Listing;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
//All Listings 
Route::get('/', [ListingController::class, 'index']);



//show create form
Route::get('/listings/create', [ListingController::class, 'create']) ->middleware('auth');

//Store listing Data
Route::post('/listings', [ListingController::class, 'store']) ->middleware('auth');

// Show edit form

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']) ->middleware('auth');

// update listings
Route::put('/listings/{listing}', [ListingController::class, 'update']) ->middleware('auth');

//delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy']) ->middleware('auth');

//manage Listings
Route::get('/listing/manage', [ListingController::class, 'manage'])->middleware('auth');


//Single listing this remains always at the end
Route::get('/listings/{listing}', [ListingController::class, 'show']);



//show Register create form
Route::get('/register', [UserController::class, 'create']) ->middleware('guest');


//create new user
Route::post('/users', [UserController::class, 'store']);

//Log user out
Route::post('/logout', [UserController::class, 'logout']) ->middleware('auth');

//show login form
Route::get('/login', [UserController::class , 'login'])->name('login') ->middleware('guest');

//login user Route
Route::post('/users/authenticate', [UserController::class, 'authenticate']);



