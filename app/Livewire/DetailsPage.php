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
        $this->ceremonyTime = WeddingSetting::get('ceremony_time', '16:00');
        $this->receptionName = WeddingSetting::get('reception_name', 'Grand Ballroom');
        $this->receptionAddress = WeddingSetting::get('reception_address', '456 Celebration Ave, Love City');
        $this->receptionStartTime = WeddingSetting::get('reception_start_time', '18:00');
        $this->receptionEndTime = WeddingSetting::get('reception_end_time', '23:00');
        $this->dressCodeTitle = WeddingSetting::get('dress_code_title', 'Formal Attire');
        $this->dressCodeDescription = WeddingSetting::get('dress_code_description', 'Cocktail dresses & suits');
        $this->dressCodeColors = WeddingSetting::get('dress_code_colors', 'Blush & Gold Welcome');

        // Format times for display with robust parsing
        $this->ceremonyTime = $this->formatTime($this->ceremonyTime, '4:00 PM');
        $startTime = $this->formatTime($this->receptionStartTime, '6:00 PM');
        $endTime = $this->formatTime($this->receptionEndTime, '11:00 PM');
        $this->receptionTimeFormatted = $startTime . ' - ' . $endTime;

        // Create Google Maps embed URL based on ceremony address
        $this->mapUrl = $this->generateMapUrl($this->ceremonyAddress);
    }

    private function formatTime(string $time, string $fallback): string
    {
        try {
            // Try multiple time formats to handle different inputs
            $formats = ['H:i:s', 'H:i', 'G:i:s', 'G:i'];
            
            foreach ($formats as $format) {
                try {
                    return Carbon::createFromFormat($format, $time)->format('g:i A');
                } catch (\Exception $e) {
                    continue;
                }
            }
            
            // If all formats fail, return fallback
            return $fallback;
        } catch (\Exception $e) {
            return $fallback;
        }
    }

    private function generateMapUrl(string $address): string
    {
        // Use Google Maps search URL for iframe - no API key needed
        $encodedAddress = urlencode($address);
        return "https://maps.google.com/maps?q={$encodedAddress}&output=embed";
    }

    public function render()
    {
        return view('livewire.details-page')->title('Wedding Details - Precious & Franklin Wedding');
    }
}
