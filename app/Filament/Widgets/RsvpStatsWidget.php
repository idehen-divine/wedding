<?php

namespace App\Filament\Widgets;

use App\Models\Rsvp;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RsvpStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalRsvps = Rsvp::count();
        $attending = Rsvp::where('attendance', 'yes')->count();
        $notAttending = Rsvp::where('attendance', 'no')->count();
        $totalGuests = Rsvp::where('attendance', 'yes')->sum('guests');

        return [
            Stat::make('Total RSVPs', $totalRsvps)
                ->description('All responses received')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('primary'),

            Stat::make('Attending', $attending)
                ->description('Guests coming to the wedding')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Not Attending', $notAttending)
                ->description('Guests unable to attend')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),

            Stat::make('Total Guests', $totalGuests)
                ->description('Total number of attendees')
                ->descriptionIcon('heroicon-o-users')
                ->color('info'),
        ];
    }
}
