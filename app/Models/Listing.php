<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'user_id',
    ];
    // Define a scope for filtering listings
    public function scopeFilter($query, array $filters)
    {
        $tags = $filters['tag'] ?? null;
        $search = $filters['search'] ?? null;

        if ($tags) {
            $query->where('tags', 'like', '%' . $tags . '%');
        }

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('tags', 'like', '%' . $search . '%');
        }
    }
    //Relationship with Users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getCategoryNameAttribute()
    {
        return $this->category_name;
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'listing_tags');
    }
    public function getTagsAttribute($value)
    {
        return Tag::find(json_decode($value, true));
    }
}
