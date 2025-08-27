<?php

namespace App\Filament\Resources\GalleryImages\Schemas;

use App\Enums\GalleryCategory;
use App\Models\GalleryImage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class GalleryImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_path')
                    ->label('Upload Images')
                    ->image()
                    ->multiple()
                    ->required()
                    ->directory('gallery-images')
                    ->visibility('public')
                    ->getUploadedFileNameForStorageUsing(
                        fn ($file): string => GalleryImage::generateFileName($file->getClientOriginalExtension())
                    )
                    ->columnSpanFull(),
                Select::make('categories')
                    ->label('Categories for All Images')
                    ->options(GalleryCategory::getOptions())
                    ->multiple()
                    ->required()
                    ->helperText('These categories will be applied to all uploaded images.')
                    ->columnSpanFull(),
            ]);
    }
}
