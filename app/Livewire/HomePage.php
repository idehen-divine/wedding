<?php

namespace App\Livewire;

use App\Models\WeddingSetting;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * Home page component displaying wedding information and countdown
 */
#[Layout('components.layouts.wedding')]
class HomePage extends Component
{
    /**
     * The bride's name
     */
    public string $brideName;

    /**
     * The groom's name
     */
    public string $groomName;

    /**
     * Wedding date in Y-m-d format
     */
    public string $weddingDate;

    /**
     * Ceremony time in H:i format
     */
    public string $ceremonyTime;

    /**
     * Human-readable formatted date
     */
    public string $formattedDate;

    /**
     * Combined wedding date and time for countdown
     */
    public string $weddingDateTime;

    /**
     * Initialize component with wedding settings
     */
    public function mount(): void
    {
        $this->brideName = WeddingSetting::get('bride_name', 'Precious');
        $this->groomName = WeddingSetting::get('groom_name', 'Franklin');
        $this->weddingDate = WeddingSetting::get('wedding_date', '2025-08-30');

        $ceremonySetting = WeddingSetting::where('key', 'ceremony_time')->first();
        $this->ceremonyTime = $ceremonySetting ? $ceremonySetting->value : '14:00';

        $this->formattedDate = Carbon::parse($this->weddingDate)->format('F j, Y');
        $this->weddingDateTime = $this->weddingDate.' '.$this->ceremonyTime.':00';
    }

    /**
     * Render the home page view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.home-page');
    }
}
