<?php

namespace App\Filament\Resources\GalleryImages\Pages;

use App\Filament\Resources\GalleryImages\GalleryImageResource;
use App\Models\GalleryImage;
use App\Models\GalleryImageCategory;
use Filament\Resources\Pages\CreateRecord;

class CreateGalleryImage extends CreateRecord
{
    protected static string $resource = GalleryImageResource::class;

    protected function handleRecordCreation(array $data): GalleryImage
    {
        // Handle multiple file uploads
        $imagePaths = $data['image_path'] ?? [];
        $categories = $data['categories'] ?? [];

        // Create a record for each uploaded image
        foreach ($imagePaths as $imagePath) {
            $image = GalleryImage::create([
                'image_path' => $imagePath,
            ]);

            // Create category relationships
            foreach ($categories as $category) {
                GalleryImageCategory::create([
                    'gallery_image_id' => $image->id,
                    'category' => $category,
                ]);
            }
        }

        // Return the last created record (Filament expects a single record)
        return GalleryImage::latest()->first();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
