<?php

namespace App\Livewire;

use App\Models\WeddingSetting;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class DetailsPage extends Component
{
    public string $ceremonyName;

    public string $ceremonyAddress;

    public string $ceremonyTime;

    public string $ceremonyTimeFormatted;

    public string $receptionName;

    public string $receptionAddress;

    public string $receptionStartTime;

    public string $receptionEndTime;

    public string $dressCodeTitle;

    public string $dressCodeDescription;

    public string $dressCodeColors;

    public string $receptionTimeFormatted;

    public string $mapUrl;

    public function mount(): void
    {
        $this->ceremonyName = WeddingSetting::get('ceremony_name', 'St. Mary\'s Cathedral');
        $this->ceremonyAddress = WeddingSetting::get('ceremony_address', '123 Wedding Lane, Love City');
        $this->ceremonyTime = WeddingSetting::get('ceremony_time');
        $this->receptionName = WeddingSetting::get('reception_name', 'Grand Ballroom');
        $this->receptionAddress = WeddingSetting::get('reception_address', '456 Celebration Ave, Love City');
        $this->receptionStartTime = WeddingSetting::get('reception_start_time');
        $this->receptionEndTime = WeddingSetting::get('reception_end_time');
        $this->dressCodeTitle = WeddingSetting::get('dress_code_title', 'Formal Attire');
        $this->dressCodeDescription = WeddingSetting::get('dress_code_description', 'Cocktail dresses & suits');
        $this->dressCodeColors = WeddingSetting::get('dress_code_colors', 'Blush & Gold Welcome');
        $this->ceremonyTimeFormatted = $this->ceremonyTime;
        $this->receptionTimeFormatted = $this->receptionStartTime .' - '. $this->receptionEndTime;
        $this->mapUrl = $this->generateMapUrl($this->ceremonyAddress);
    }

    private function generateMapUrl(string $address): string
    {
        $encodedAddress = urlencode($address);

        return "https://maps.google.com/maps?q={$encodedAddress}&output=embed";
    }

    public function render()
    {
        return view('livewire.details-page')->title('Wedding Details - Precious & Franklin Wedding');
    }
}
