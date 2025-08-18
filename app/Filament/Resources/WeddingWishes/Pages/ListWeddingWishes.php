<?php

namespace App\Filament\Resources\WeddingWishes\Pages;

use App\Filament\Resources\WeddingWishes\WeddingWishResource;
use Filament\Resources\Pages\ListRecords;

class ListWeddingWishes extends ListRecords
{
    protected static string $resource = WeddingWishResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //  
        ];
    }
}
