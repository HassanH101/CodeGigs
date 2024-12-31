<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function index()
    {
        // Retrieve the latest listings, filtered by tag and search query
        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);

        // Return a view with the filtered and paginated listings
        return view('listings.index', compact('listings'));
    }

    // Return a view with the specified listing
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }
    public function create()
    {
        // Return the create form view
        return view('listings.create');
    }
    //Store Listing
    public function store(Request $request)
    {
        // Validate the request data
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);


        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = Auth::id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }
    // Show Edit Form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }
    //Update Listing
    public function update(Request $request, Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != Auth::id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }
    //Delete Listing
    public function destroy(Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != Auth::id()) {
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }
    public function manage()
    {
        $user = Auth::user();
        $listings = $user->listings;

        return view('listings.manage', ['listings' => $listings]);
    }
}
