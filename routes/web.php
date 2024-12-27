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
Route::post('/listings', [ListingController::class, 'store']);
//Show Edit Form
Route::get('/listing/{listing}/edit', [ListingController::class, 'edit']);
//Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);