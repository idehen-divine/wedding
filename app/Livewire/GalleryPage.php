<?php

namespace App\Livewire;

use App\Models\WeddingSetting;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class GalleryPage extends Component
{
    public bool $isPublished = false;

    public function mount()
    {
        $this->isPublished = WeddingSetting::get('gallery_published', false);
    }

    public function render()
    {
        return view('livewire.gallery-page')->title('Photo Gallery - Precious & Franklin Wedding');
    }
}
