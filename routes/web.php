<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/components/buttons', function () {
    return Inertia::render('Components/Buttons');
})->middleware(['auth', 'verified'])->name('components.buttons');


Route::group(['middleware' => 'auth', 'as' => 'articles.'], function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('store');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('show');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';
