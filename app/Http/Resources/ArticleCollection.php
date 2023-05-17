<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     */
    public function toArray(Request $request)
    {
        return ArticleResource::collection($this->collection);
    }
}
