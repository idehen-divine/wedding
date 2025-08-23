<?php

namespace App\Filament\Resources\StoryTimelines\Pages;

use App\Filament\Resources\StoryTimelines\StoryTimelineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStoryTimelines extends ListRecords
{
    protected static string $resource = StoryTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
