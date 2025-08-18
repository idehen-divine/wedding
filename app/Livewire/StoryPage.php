<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class StoryPage extends Component
{
    public function render()
    {
        return view('livewire.story-page')->title('Our Love Story - Precious & Franklin Wedding');
    }
}
