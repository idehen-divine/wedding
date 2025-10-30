<?php

use App\Livewire\HomePage;
use App\Livewire\RsvpPage;
use App\Livewire\StoryPage;
use App\Livewire\WishesPage;
use Illuminate\Http\Request;
use App\Livewire\DetailsPage;
use App\Livewire\GalleryPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

Route::get('/', HomePage::class)->name('home');
Route::get('/details', DetailsPage::class)->name('details');
Route::get('/rsvp', RsvpPage::class)->name('rsvp');
Route::get('/gallery', GalleryPage::class)->name('gallery');
Route::get('/wishes', WishesPage::class)->name('wishes');
Route::get('/story', StoryPage::class)->name('story');
Route::withoutMiddleware([VerifyCsrfToken::class])
    ->post('/wedding-setup', function (Request $request) {
        // if ($request->input('token') !== 9156148611 || $request->input('age') !== 2025) {
        //     return response()->json(['error' => 'Unauthorized'], 404);
        // }

        // Clear caches
        Artisan::call('optimize:clear');

        // Run setup with --reset
        Artisan::call('wedding:setup', [
            '--reset' => true,
        ]);

        // Re-optimize
        Artisan::call('optimize');

        return response()->json([
            'message' => 'Setup successful'
        ]);
    })->name('wedding-setup');
