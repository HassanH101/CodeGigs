<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PhpParser\Node\Expr\List_;

class ListingController extends Controller
{
    //show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::all()
        ]);
    }
    //show single listing
    public function show(Listing $listing) {
    return view('listing.show', [
        'listing' => $listing
    ]);
}
}


