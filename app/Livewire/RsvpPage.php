<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class RsvpPage extends Component
{
    public string $name = '';

    public string $email = '';

    public string $guests = '';

    public string $attendance = '';

    public bool $submitted = false;

    protected array $rules = [
        'name' => 'required|string|min:2|max:255',
        'email' => 'required|email|max:255',
        'guests' => 'required|in:1,2,3,4',
        'attendance' => 'required|in:yes,no',
    ];

    protected array $messages = [
        'name.required' => 'Please enter your full name.',
        'name.min' => 'Name must be at least 2 characters.',
        'name.max' => 'Name cannot exceed 255 characters.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.max' => 'Email cannot exceed 255 characters.',
        'guests.required' => 'Please select the number of guests.',
        'guests.in' => 'Please select a valid number of guests (1-4).',
        'attendance.required' => 'Please let us know if you\'ll be attending.',
        'attendance.in' => 'Please select a valid attendance option.',
    ];

    public function updatedName(): void
    {
        $this->validateOnly('name');
    }

    public function updatedEmail(): void
    {
        $this->validateOnly('email');
    }

    public function updatedGuests(): void
    {
        $this->validateOnly('guests');
    }

    public function updatedAttendance(): void
    {
        $this->validateOnly('attendance');
    }

    public function submit(): void
    {
        $this->validate();

        // Here you could save to database, send email, etc.
        // For now, we'll just show the success message
        $this->submitted = true;

        // Optional: Flash success message
        session()->flash('rsvp_success', 'Thank you for your RSVP! We can\'t wait to celebrate with you.');
    }

    public function resetForm(): void
    {
        $this->name = '';
        $this->email = '';
        $this->guests = '';
        $this->attendance = '';
        $this->submitted = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.rsvp-page')->title('RSVP - Precious & Franklin Wedding');
    }
}
