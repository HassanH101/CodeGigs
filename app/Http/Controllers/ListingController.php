<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\User;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $listings = Listing::latest()->paginate(6);

        $tagNames = []; // Create an empty array to store tag names

        foreach ($listings as $listing) {
            $listing->tags = $listing->tags; // Use the accessor method to convert the JSON string to an array of tag IDs
            $tagNames[$listing->id] = $listing->tags; // Store the tag names in the array
        }

        return view('listings.index', compact('listings', 'tagNames')); // Pass the $tagNames array to the view
    }

    // Return a view with the specified listing
    public function show(Listing $listing)
    {
        $listing->tags = $listing->tags; // Use the accessor method to convert the JSON string to an array of tag IDs

        return view('listings.show', compact('listing'));
    }
    // Store Listing
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required|array',
            'category_id' => ['required', 'exists:categories,id'],
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formFields['user_id'] = Auth::id();

        $formFields['tags'] = json_encode($request->input('tags'));

        $listing = Listing::create($formFields);
        // Insert tags into listing_tags table
        foreach ($request->input('tags') as $tagId) {
            $listing->tags()->attach($tagId);
        }

        return redirect('/')->with('message', 'Listing created successfully!');
    }


    // Update Listing
    public function update(Request $request, Listing $listing)
    {
        if (Auth::user()->role == 'admin' || Auth::id() == $listing->user_id) {
            $formFields = $request->validate([
                'title' => 'required',
                'company' => 'required',
                'location' => 'required',
                'website' => 'required',
                'email' => 'required|email',
                'category_id' => 'required|exists:categories,id',
                'description' => 'required',
                'tags' => 'required|array',
                'tags.*' => 'exists:tags,id',
            ]);

            if ($request->hasFile('logo')) {
                $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            }

            $listing->update($formFields);

            // Sync tags with the listing
            $listing->tags()->sync($request->input('tags'));

            return redirect('/')->with('message', 'Listing updated successfully!');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    // Delete Listing
    public function destroy(Listing $listing)
    {
        if ($listing->user_id == Auth::id() || Auth::user()->role == 'admin') {
            // Detach tags before deleting the listing
            $listing->tags()->detach();
            $listing->delete();

            return redirect('/')->with('message', 'Listing deleted successfully!');
        } else {
            // Make sure logged-in user is the owner
            abort(403, 'Unauthorized Action');
        }
    }

    public function manage()
    {
        if (Auth::user()->role == 'admin') {
            $listings = Listing::with('tags')->get(); // Load tags with listings
            return view('listings.manage', compact('listings'));
        }

        $user = Auth::user();
        $listings = User::find(Auth::id())->listings()->with('tags')->get();

        return view('listings.manage', compact('listings'));
    }
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('listings.create', compact('categories', 'tags'));
    }

    public function edit(Listing $listing)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('listings.edit', compact('listing', 'categories', 'tags'));
    }
}
