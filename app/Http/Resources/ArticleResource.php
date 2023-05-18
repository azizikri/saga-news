<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category->name,
            'author' => $this->user->name,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'banner' => $this->banner,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
