<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class DetailsPage extends Component
{
    public function render()
    {
        return view('livewire.details-page')->title('Wedding Details - Precious & Franklin Wedding');
    }
}
