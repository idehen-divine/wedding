<?php

namespace App\Filament\Resources\WeddingSettings;

use App\Models\WeddingSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;

class WeddingSettingResource extends Resource
{
    protected static ?string $model = WeddingSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog8Tooth;

    protected static ?string $navigationLabel = 'Settings';

    protected static ?int $navigationSort = 4;

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageWeddingSettings::route('/'),
        ];
    }
}
