<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class WishesPage extends Component
{
    public function render()
    {
        return view('livewire.wishes-page')->title('Guest Wishes - Precious & Franklin Wedding');
    }
}
