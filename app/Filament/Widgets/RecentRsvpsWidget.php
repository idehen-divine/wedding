<?php

namespace App\Filament\Widgets;

use App\Models\Rsvp;
use Filament\Widgets\Widget;

class RecentRsvpsWidget extends Widget
{
    protected string $view = 'filament.widgets.recent-rsvps-widget';

    protected int|string|array $columnSpan = 'full';

    public function getRecentRsvps()
    {
        return Rsvp::latest()->limit(5)->get();
    }
}
