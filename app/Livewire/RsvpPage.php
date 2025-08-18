<?php

namespace App\Livewire;

use App\Models\Rsvp;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class RsvpPage extends Component
{
    public string $name = '';
    public string $email = '';
    public string $whatsapp = '';
    public string $guests = '';
    public string $attendance = '';
    public bool $submitted = false;


    public function submit(): void
    {
        try {
            // Basic safety checks to prevent database errors
            if (empty(trim($this->name)) || empty(trim($this->email)) || empty($this->guests) || empty($this->attendance)) {
                $this->dispatch('rsvp-error', 'Please fill in all required fields.');
                return;
            }

            // Save RSVP to database (client-side validation already handled)
            Rsvp::create([
                'name' => trim($this->name),
                'email' => trim($this->email),
                'whatsapp' => $this->whatsapp ? trim($this->whatsapp) : null,
                'guests' => (int) $this->guests,
                'attendance' => $this->attendance,
            ]);

            $this->submitted = true;

            // Dispatch success event for SweetAlert2
            $this->dispatch('rsvp-submitted');

            // Flash success message
            session()->flash('rsvp_success', 'Thank you for your RSVP! We can\'t wait to celebrate with you.');
        } catch (\Exception $e) {
            // Only catch genuine errors (database issues, etc.)
            $this->dispatch('rsvp-error', 'Something went wrong. Please try again.');
        }
    }

    public function resetForm(): void
    {
        $this->name = '';
        $this->email = '';
        $this->whatsapp = '';
        $this->guests = '';
        $this->attendance = '';
        $this->submitted = false;
    }

    public function render()
    {
        return view('livewire.rsvp-page')->title('RSVP - Precious & Franklin Wedding');
    }
}
