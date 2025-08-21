<?php

namespace App\Livewire;

use App\Models\WeddingWish;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.wedding')]
class WishesPage extends Component
{
    public string $name = '';
    public string $wish = '';

    public function submitWish(): void
    {
        try {
            // Basic safety checks to prevent database errors
            if (empty(trim($this->name)) || empty(trim($this->wish))) {
                $this->dispatch('wish-error', 'Please fill in all required fields.');
                return;
            }

            // Validate the data
            $this->validate([
                'name' => 'required|string|min:2|max:255',
                'wish' => 'required|string|min:10|max:1000',
            ]);

            // Save wish to database
            WeddingWish::create([
                'name' => trim($this->name),
                'wish' => trim($this->wish),
                'approved' => true
            ]);

            // Reset form data
            $this->reset(['name', 'wish']);

            // Dispatch success event for SweetAlert2
            $this->dispatch('wish-submitted');

            // Flash success message
            session()->flash('wish_success', 'Thank you for your beautiful wish! It has been added.');
        } catch (\Exception $e) {
            // Only catch genuine errors (database issues, etc.)
            $this->dispatch('wish-error', 'Something went wrong. Please try again.');
        }
    }

    public function render()
    {
        $approvedWishes = WeddingWish::where('approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.wishes-page', compact('approvedWishes'));
    }
}
