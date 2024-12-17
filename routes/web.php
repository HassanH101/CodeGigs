<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
//All Listings
Route::get('/', [ListingController::class, 'index']);

//Create listing
Route::get('/listings/create', [ListingController::class, 'create']);

//Store Listing data 
Route::get('/listings', [ListingController::class, 'store']);

//Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);