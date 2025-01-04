<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Tag; // Import Tag model
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


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
    // Store Listing
    public function store(Request $request)
    {
        // Validate the request data
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'category_id' => ['required', 'exists:categories,id'], // Validate category_id
            'tags' => 'array', // Ensure tags is an array
            'tags.*' => ['exists:tags,id'], // Validate each tag ID exists
            'description' => 'required',
        ]);

        // Retrieve the tag names based on the selected tag IDs
        $tagNames = Tag::whereIn('id', $formFields['tags'])->pluck('name')->toArray();

        // Convert tag names to string
        $formFields['tags'] = implode(',', $tagNames);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = Auth::id();

        // Create the listing without tags first
        $listing = Listing::create($formFields);

        // Attach tags to the listing
        if ($request->has('tags')) {
            $listing->tags()->attach($request->tags);
        }

        return redirect('/')->with('message', 'Listing created successfully!');
    }
    // Update Listing
    public function update(Request $request, Listing $listing)
    {
        if (Auth::user()->role == 'admin' || Auth::id() == $listing->user_id) {
            $formFields = $request->validate([
                'title' => 'required',
                'company' => ['required'],
                'location' => 'required',
                'website' => 'required',
                'email' => ['required', 'email'],
                'category_id' => ['required', 'exists:categories,id'], // Validate category_id
                'tags' => 'array',
                'tags.*' => ['exists:tags,id'], // Validate tags
                'description' => 'required',
            ]);

            // Retrieve the tag names based on the selected tag IDs
            $tagNames = Tag::whereIn('id', $formFields['tags'])->pluck('name')->toArray();

            // Convert tag names to string
            $formFields['tags'] = implode(',', $tagNames);

            if ($request->hasFile('logo')) {
                $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            }

            // Update listing
            $listing->fill($formFields);

            // Update category
            $listing->category_id = $request->category_id;

            // Remove existing tags
            $listing->tags()->detach();

            // Attach new tags
            if ($request->has('tags')) {
                $listing->tags()->sync($request->tags);
            }

            $listing->save();

            return redirect('/')->with('message', 'Listing updated successfully!');
        } else {
            // Make sure logged-in user is the owner
            abort(403, 'Unauthorized Action');
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
        $listings = $user->Auth::listings()->with('tags')->get();

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
