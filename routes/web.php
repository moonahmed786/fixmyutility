<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BlogController;
use App\Livewire\Bills;
use App\Livewire\BillDetail;
use App\Livewire\Dashboard;
use App\Livewire\Disputes;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

// ─── Public Routes ────────────────────────────────────────────────────────────
Route::get('/',                         Home::class)->name('home');
Route::get('/about',                    [PageController::class, 'about'])->name('about');
Route::get('/contact',                  [PageController::class, 'contact'])->name('contact');
Route::post('/contact',                 [PageController::class, 'sendContact'])->name('contact.send');
Route::get('/pricing',                  [PageController::class, 'pricing'])->name('pricing');

Route::get('/services',                 [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}',  [ServiceController::class, 'show'])->name('services.show');

Route::get('/blog',                     [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}',         [BlogController::class, 'show'])->name('blog.show');

// ─── Authenticated Dashboard Routes ──────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    // Overview
    Route::get('/dashboard',                Dashboard::class)->name('dashboard');

    // Bills
    Route::get('/dashboard/bills',          Bills::class)->name('bills.index');
    Route::get('/dashboard/bills/{bill}',   BillDetail::class)->name('bills.show');

    // Disputes
    Route::get('/dashboard/disputes',       Disputes::class)->name('disputes.index');

    // Profile
    Route::view('/profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';
