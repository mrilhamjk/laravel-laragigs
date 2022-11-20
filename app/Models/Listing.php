<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $tag = "%{$filters['tag']}%";
            $query->where('tags', 'like', $tag);
        }

        if ($filters['search'] ?? false) {
            $search = "%{$filters['search']}%";
            $query->where('title', 'like', $search)
                ->orWhere('description', 'like', $search)
                ->orWhere('tags', 'like', $search);
        }
    }

    // Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
