<?php

namespace App\Filament\Resources\StoryTimelines;

use App\Filament\Resources\StoryTimelines\Pages\CreateStoryTimeline;
use App\Filament\Resources\StoryTimelines\Pages\EditStoryTimeline;
use App\Filament\Resources\StoryTimelines\Pages\ListStoryTimelines;
use App\Filament\Resources\StoryTimelines\Schemas\StoryTimelineForm;
use App\Filament\Resources\StoryTimelines\Tables\StoryTimelinesTable;
use App\Models\StoryTimeline;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StoryTimelineResource extends Resource
{
    protected static ?string $model = StoryTimeline::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Story Timeline';

    protected static ?string $modelLabel = 'Story Event';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return StoryTimelineForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoryTimelinesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStoryTimelines::route('/'),
            'create' => CreateStoryTimeline::route('/create'),
            'edit' => EditStoryTimeline::route('/{record}/edit'),
        ];
    }
}
