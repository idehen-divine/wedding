<?php

namespace App\Livewire;

use App\Models\Rsvp;
use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * RSVP page component for collecting guest responses
 */
#[Layout('components.layouts.wedding')]
class RsvpPage extends Component
{
    /**
     * Guest's full name
     */
    public string $name = '';

    /**
     * Guest's email address
     */
    public string $email = '';

    /**
     * Guest's WhatsApp number (optional)
     */
    public string $whatsapp = '';

    /**
     * Number of guests attending
     */
    public string $guests = '';

    /**
     * Attendance status (yes/no)
     */
    public string $attendance = '';

    /**
     * Form submission status
     */
    public bool $submitted = false;

    /**
     * Process RSVP form submission
     */
    public function submit(): void
    {
        try {
            if (empty(trim($this->name)) || empty(trim($this->email)) || empty($this->guests) || empty($this->attendance)) {
                $this->dispatch('rsvp-error', 'Please fill in all required fields.');

                return;
            }

            Rsvp::create([
                'name' => trim($this->name),
                'email' => trim($this->email),
                'whatsapp' => $this->whatsapp ? trim($this->whatsapp) : null,
                'guests' => (int) $this->guests,
                'attendance' => $this->attendance,
            ]);

            $this->submitted = true;
            $this->dispatch('rsvp-submitted');
            session()->flash('rsvp_success', 'Thank you for your RSVP! We can\'t wait to celebrate with you.');
        } catch (\Exception $e) {
            $this->dispatch('rsvp-error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Reset form to initial state
     */
    public function resetForm(): void
    {
        $this->name = '';
        $this->email = '';
        $this->whatsapp = '';
        $this->guests = '';
        $this->attendance = '';
        $this->submitted = false;
    }

    /**
     * Render the RSVP page view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.rsvp-page')->title('RSVP - Precious & Franklin Wedding');
    }
}
