<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, Slugable;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['keyword'] ?? false, fn($query) => $query->where('title', 'LIKE', "%{$filters['keyword']}%"));

        $query->when($filters['category_slug'] ?? false, fn($query) => $query->whereRelation('category', 'slug', $filters['category_slug']));
    }
}
