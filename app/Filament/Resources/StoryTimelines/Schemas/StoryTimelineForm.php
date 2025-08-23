<?php

namespace App\Filament\Resources\StoryTimelines\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StoryTimelineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Story Details')
                    ->components([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., First Meeting'),
                        TextInput::make('date')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., September 2019'),
                        Textarea::make('description')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000)
                            ->placeholder('Tell your story...')
                            ->columnSpanFull(),
                    ]),
                
                Section::make('Media & Display')
                    ->columns(2)
                    ->components([
                        FileUpload::make('image_path')
                            ->label('Story Image')
                            ->image()
                            ->disk('public')
                            ->directory('story-images')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('3:2')
                            ->maxSize(5120)
                            ->columnSpanFull(),
                        TextInput::make('sort_order')
                            ->label('Display Order')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                        Toggle::make('is_active')
                            ->label('Show on website')
                            ->default(true),
                    ]),
            ]);
    }
}
