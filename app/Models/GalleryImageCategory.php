<?php

namespace App\Models;

use App\Enums\GalleryCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImageCategory extends Model
{
    protected $fillable = [
        'gallery_image_id',
        'category',
    ];

    protected function casts(): array
    {
        return [
            // Remove the cast so we get the raw string value
            // 'category' => GalleryCategory::class,
        ];
    }

    public function getCategoryEnumAttribute(): GalleryCategory
    {
        return GalleryCategory::from($this->category);
    }

    public function galleryImage(): BelongsTo
    {
        return $this->belongsTo(GalleryImage::class);
    }
}
