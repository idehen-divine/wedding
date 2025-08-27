<?php

namespace App\Livewire;

use App\Enums\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\WeddingSetting;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class GalleryPage extends Component
{
    public bool $isPublished = false;
    public $selectedCategory = 'all';

    public function mount()
    {
        $this->isPublished = WeddingSetting::get('gallery_published', false);
    }

    public function getGalleryImagesProperty()
    {
        $query = GalleryImage::ordered();
        
        if ($this->selectedCategory !== 'all') {
            $category = GalleryCategory::from($this->selectedCategory);
            $query->byCategory($category);
        }
        
        return $query->get();
    }

    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
    }

    public function render()
    {
        return view('livewire.gallery-page', [
            'galleryImages' => $this->galleryImages
        ])->title('Photo Gallery - Precious & Franklin Wedding');
    }
}
