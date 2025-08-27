<?php

namespace App\Enums;

enum GalleryCategory: string
{
    case CEREMONY = 'ceremony';
    case RECEPTION = 'reception';
    case FAMILY = 'family';
    case COUPLE = 'couple';

    public function getLabel(): string
    {
        return match ($this) {
            self::CEREMONY => 'ceremony',
            self::RECEPTION => 'reception',
            self::FAMILY => 'family',
            self::COUPLE => 'couple',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::CEREMONY => 'success',
            self::RECEPTION => 'warning',
            self::FAMILY => 'info',
            self::COUPLE => 'danger',
        };
    }

    public static function getOptions(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->getLabel()])
            ->toArray();
    }
}