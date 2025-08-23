<?php

namespace App\Livewire;

use App\Models\StoryTimeline;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class StoryPage extends Component
{
    public function render()
    {
        $storyEvents = StoryTimeline::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('livewire.story-page', compact('storyEvents'))
            ->title('Our Love Story - Precious & Franklin Wedding');
    }
}
