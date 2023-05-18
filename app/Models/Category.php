<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Slugable;

    protected $guarded = ['id'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['name'] ?? false, fn($query) => $query->where('name', 'LIKE', "%{$filters['name']}%"));

    }
}
