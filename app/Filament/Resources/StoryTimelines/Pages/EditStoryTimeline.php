<?php

namespace App\Filament\Resources\StoryTimelines\Pages;

use App\Filament\Resources\StoryTimelines\StoryTimelineResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStoryTimeline extends EditRecord
{
    protected static string $resource = StoryTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
