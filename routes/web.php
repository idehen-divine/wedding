<?php

use App\Livewire\DetailsPage;
use App\Livewire\GalleryPage;
use App\Livewire\HomePage;
use App\Livewire\RsvpPage;
use App\Livewire\StoryPage;
use App\Livewire\WishesPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/details', DetailsPage::class)->name('details');
Route::get('/rsvp', RsvpPage::class)->name('rsvp');
Route::get('/gallery', GalleryPage::class)->name('gallery');
Route::get('/wishes', WishesPage::class)->name('wishes');
Route::get('/story', StoryPage::class)->name('story');
