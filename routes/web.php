<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('listings', ['heading' => 'Latest Listings']);
    
});

