<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;
use App\Http\Requests\Api\ArticleFilterRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ArticleFilterRequest $request)
    {
        $data = $request->validated();

        $articles = Article::query()->with(['category', 'user'])->filter($data)->latest()->paginate(10);

        return new ArticleCollection($articles);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }
}
