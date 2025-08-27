<?php

namespace App\Models;

use App\Enums\GalleryCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\GalleryImageCategory;
use Illuminate\Support\Facades\Storage;

class GalleryImage extends Model
{
    protected $fillable = [
        'image_path',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(GalleryImageCategory::class, 'gallery_image_id');
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_path)
        );
    }

    public function scopeByCategory($query, GalleryCategory $category)
    {
        return $query->whereHas('categories', function ($q) use ($category) {
            $q->where('category', $category->value);
        });
    }

    public function getCategoriesEnumAttribute()
    {
        return $this->categories()->pluck('category')->map(function ($category) {
            return GalleryCategory::from($category);
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public static function generateFileName($extension = 'jpg'): string
    {
        $count = self::count() + 1;
        $number = str_pad($count, 4, '0', STR_PAD_LEFT);
        return "precious-and-franklin-2025-{$number}.{$extension}";
    }

    public function getCategories()
    {
        $categories = $this->categories()->pluck('category');

        $category = $categories->map(function ($value) {
            $enum = GalleryCategory::from($value);

            return [
                'name' => $enum->value,
                'color' => $enum->getColor()
            ];
        })->toArray();
    }
}
