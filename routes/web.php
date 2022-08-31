<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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

//All Listing 
Route::get('/', [ListingController::class, 'index']);

//Show Create Form 
Route::get('/listings/create', [ListingController::class, 'create']);

//Store Listing Dtat
Route::post('/listings', [ListingController::class, 'store']);

//Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

//Upadte listing
Route::put('/listings/{listing}', [ListingController::class, 'update']);

//Single Listing 
Route::get('/listings/{listing}', [ListingController::class, 'show']);

