<?php

namespace App\Filament\Resources\StoryTimelines\Pages;

use App\Filament\Resources\StoryTimelines\StoryTimelineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStoryTimeline extends CreateRecord
{
    protected static string $resource = StoryTimelineResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
