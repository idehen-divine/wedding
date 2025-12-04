<?php

namespace App\Filament\Widgets;

use App\Models\WeddingWish;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WeddingWishesStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalWishes = WeddingWish::count();
        $approvedWishes = WeddingWish::where('approved', true)->count();
        $pendingWishes = WeddingWish::where('approved', false)->count();

        return [
            Stat::make('Total Wishes', $totalWishes)
                ->description('All wishes received')
                ->descriptionIcon('heroicon-o-heart')
                ->color('primary'),

            Stat::make('Approved', $approvedWishes)
                ->description('Visible on website')
                ->descriptionIcon('heroicon-o-check-badge')
                ->color('success'),

            Stat::make('Pending Approval', $pendingWishes)
                ->description('Awaiting review')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
        ];
    }
}
