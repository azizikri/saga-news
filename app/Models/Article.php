<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, Slugable;

    const BANNER_PATH = 'images/articles';

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Author',
        ]);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['keyword'] ?? false, fn($query) => $query->where('title', 'LIKE', "%{$filters['keyword']}%"));

        $query->when($filters['category_slug'] ?? false, fn($query) => $query->whereRelation('category', 'slug', $filters['category_slug']));
    }

    public function getBannerUrlAttribute()
    {
        return Storage::url($this->banner);
    }
}
