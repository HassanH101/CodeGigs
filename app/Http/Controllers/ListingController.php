<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    /**
     * Display a listing of all listings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve the latest listings, filtered by tag and search query
        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);

        // Return a view with the filtered and paginated listings
        return view('listings.index', compact('listings'));
    }

    /**
     * Display a single listing.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\View\View
     */
    public function show(Listing $listing)
    {
        // Return a view with the specified listing
        return view('listings.show', compact('listing'));
    }

    /**
     * Show the form for creating a new listing.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Return the create form view
        return view('listings.create');
    }

    /**
     * Store a newly created listing in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        // Check if the image is uploaded
        if (!$request->hasFile('logo')) {
            return response()->json(['error' => 'Logo is required'], 422);
        }

        // Get the logo file name
        $logoFileName = $request->file('logo')->getClientOriginalName();

        // Check if the logo file name is null
        if (!$logoFileName) {
            return response()->json(['error' => 'Logo file name is required'], 422);
        }

        // Store the logo file
        $logoPath = $request->file('logo')->store('logos', 'public');

        // Get the user ID
        $userId = Auth::id();

        // Check if the user is authenticated
        if (!$userId) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }

        // Create a new listing
        $listing = Listing::create(array_merge($validatedData, [
            'logo' => $logoPath,
            'user_id' => $userId,
        ]));

        // Return a success response
        return redirect()->with('message', 'Listing created successfully!');
    }
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }
}
