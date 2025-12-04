<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (request()->isSecure() || request()->header('X-Forwarded-Proto') === 'https') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        Livewire::component('app.filament.widgets.rsvp-stats-widget', \App\Filament\Widgets\RsvpStatsWidget::class);
        Livewire::component('app.filament.widgets.wedding-wishes-stats-widget', \App\Filament\Widgets\WeddingWishesStatsWidget::class);
        Livewire::component('app.filament.widgets.recent-rsvps-widget', \App\Filament\Widgets\RecentRsvpsWidget::class);
    }
}
