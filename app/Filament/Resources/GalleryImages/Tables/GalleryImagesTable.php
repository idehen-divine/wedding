<?php

namespace App\Filament\Resources\GalleryImages\Tables;

use App\Enums\GalleryCategory;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GalleryImagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('public')
                    ->square()
                    ->size(150),
                TextColumn::make('custom')
                    ->label('Categories')
                    ->getStateUsing(function ($record) {
                        return $record->categories()->pluck('category')->unique()->sort()->values()->toArray();
                    })
                    ->color(fn($state): string => match ($state) {
                        GalleryCategory::CEREMONY->getLabel() => 'success',
                        GalleryCategory::RECEPTION->getLabel() => 'warning',
                        GalleryCategory::FAMILY->getLabel() => 'info',
                        GalleryCategory::COUPLE->getLabel() => 'danger',
                        default => 'gray',
                    })
                    ->badge()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Uploaded At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
