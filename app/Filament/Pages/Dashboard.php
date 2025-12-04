<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\RecentRsvpsWidget;
use App\Filament\Widgets\RsvpStatsWidget;
use App\Filament\Widgets\WeddingWishesStatsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{    protected function getHeaderWidgets(): array
    {
        return [
            RsvpStatsWidget::class,
            WeddingWishesStatsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            RecentRsvpsWidget::class,
        ];
    }
}
