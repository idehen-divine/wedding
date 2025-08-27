<?php

namespace App\Filament\Resources\GalleryImages\Pages;

use App\Filament\Resources\GalleryImages\GalleryImageResource;
use App\Models\GalleryImage;
use App\Models\GalleryImageCategory;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGalleryImages extends ListRecords
{
    protected static string $resource = GalleryImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->form(GalleryImageResource::getFormSchema())
                ->using(function (array $data) {
                    // Handle multiple file uploads in modal
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

                    return GalleryImage::latest()->first();
                }),
        ];
    }
}
