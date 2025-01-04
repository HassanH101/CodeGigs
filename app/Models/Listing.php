<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable = ['title','company','location','website','email','description','tags'];

    // Define a scope for filtering listings
    public function scopeFilter($query, array $filters)
    {
        // Check if a tag filter is applied
        if ($filters['tag'] ?? false) {
            // Filter listings by tag
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        // Check if a search filter is applied
        if ($filters['search'] ?? false) {
            // Filter listings by title, description, or tags
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }
    //Relationship with Users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // app/Models/Listing.php

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'listing_tags');
    }
}
