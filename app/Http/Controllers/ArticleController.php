<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = [
            'keyword' => Request::input('keyword'),
        ];
        
        // $articles = Article::query()->with(['category', 'user'])->where('user_id', auth()->id())->paginate(10);
        $articles = Article::query()->with(['category', 'user'])->filter($filters)->latest()->paginate(5);

        // dd($articles);
        return Inertia::render('Articles/Index', [
            'articles' => $articles->through(fn ($article) => [
                'id' => $article->id,
                'title' => $article->title,
                'slug' => $article->slug,
                'category' => $article->category->name,
                'user' => $article->user->name,
                'created_at' => $article->created_at->diffForHumans(),
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->pluck('name', 'id');

        return Inertia::render('Articles/Form', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['title'];

        $data['banner'] = $request->file('banner')->store('articles');

        auth()->user()->articles()->create($data);

        return redirect()->route('articles.index')->withSuccess('Article created.');
    }

    public function show(Article $article)
    {
        $article = [
            'id' => $article->id,
            'title' => $article->title,
            'content' => $article->content,
            'category' => $article->category->name,
            'user' => $article->user->name,
            'banner' => $article->banner_url,
            'created_at' => $article->created_at->diffForHumans(),
        ];
        return Inertia::render('Articles/Show', [
            'article' => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::query()->pluck('name', 'id');

        return Inertia::render('Articles/Form', [
            'article' => $article,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        if ($request->title != null) {
            $data['slug'] = $data['title'];
        }

        if ($request->hasFile('banner')) {
            Storage::delete($article->banner);
            $data['banner'] = $request->file('banner')->store('articles');
        }

        $article->update($data);

        return redirect()->route('articles.index')->withSuccess('Article updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Storage::delete($article->banner);

        $article->delete();

        return redirect()->route('articles.index')->withSuccess('Article deleted.');
    }
}
