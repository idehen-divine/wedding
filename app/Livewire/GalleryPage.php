<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class GalleryPage extends Component
{
    public function render()
    {
        return view('livewire.gallery-page')->title('Photo Gallery - Precious & Franklin Wedding');
    }
}
