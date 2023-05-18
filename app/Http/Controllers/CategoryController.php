<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = [
            'name' => request(['name']),
        ];

        $categories = Category::query()->filter($filters)->latest()->paginate(5);

        return Inertia::render('Categories/Index', [
            'categories' => $categories->through(fn ($category) => [
                'name' => $category->name,
                'slug' => $category->slug,
                'articles_count' => $category->articles->count(),
                'created_at' => $category->created_at->diffForHumans(),
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Categories/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $data['name'];

        Category::create($data);

        return redirect()->route('categories.index')->withSuccess('Category created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Categories/Form', [
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        if ($request->title != null) {
            $data['slug'] = $data['title'];
        }

        $category->update($data);

        return redirect()->route('categories.index')->withSuccess('Category updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->withSuccess('Category deleted.');
    }
}
