<?php

namespace App\Livewire;

use App\Models\StoryTimeline;
use App\Models\WeddingSetting;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class StoryPage extends Component
{
    public Collection $storyEvents;
    public string $weddingHashtag;
    public ?string $instagramUrl;
    public ?string $facebookUrl;
    public ?string $twitterUrl;

    public function mount(): void
    {
        $this->storyEvents = StoryTimeline::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $this->weddingHashtag = WeddingSetting::get('wedding_hashtag', '#PreciousAndFranklinForever');
        $this->instagramUrl = WeddingSetting::get('instagram_url');
        $this->facebookUrl = WeddingSetting::get('facebook_url');
        $this->twitterUrl = WeddingSetting::get('twitter_url');
    }

    public function render()
    {
        return view('livewire.story-page')
            ->title('Our Love Story - Precious & Franklin Wedding');
    }
}
