<?php

namespace App\Livewire;

use App\Models\WeddingSetting;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class HomePage extends Component
{
    public string $brideName;
    public string $groomName;
    public string $weddingDate;
    public string $ceremonyTime;
    public string $formattedDate;
    public string $weddingDateTime;

    public function mount(): void
    {
        $this->brideName = WeddingSetting::get('bride_name', 'Precious');
        $this->groomName = WeddingSetting::get('groom_name', 'Franklin');
        $this->weddingDate = WeddingSetting::get('wedding_date', '2025-08-30');
        $this->ceremonyTime = WeddingSetting::get('ceremony_time', '14:00');
        $this->formattedDate = Carbon::parse($this->weddingDate)->format('F j, Y');
        $this->weddingDateTime = $this->weddingDate . ' ' . $this->ceremonyTime . ':00';
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
