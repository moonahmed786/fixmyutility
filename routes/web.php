<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;
use App\Livewire\Home;
use App\Livewire\Dashboard;

Route::get('/', Home::class)->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});
