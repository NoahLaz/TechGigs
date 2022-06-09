<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = ["title", "description", "location", "company", "tags", "website", "email"];

    use HasFactory;

    public function scopeFilter($query, $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'LIKE', '%' . $filters['tag'] . '%');
        }
        if ($filters['search'] ?? false) {
            $query->where('title', 'LIKE', '%' . $filters['search'] . '%')
                ->orWhere('description', 'LIKE', '%' . $filters['search'] . '%')
                ->orWhere('tags', 'LIKE', '%' . $filters['search'] . '%')
                ->orWhere('location', 'LIKE', '%' . $filters['search'] . '%');
        }
    }
}
