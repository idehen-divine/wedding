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
    public bool $showSuccessMessage = false;

    protected array $rules = [
        'name' => 'required|string|min:2|max:255',
        'wish' => 'required|string|min:10|max:1000',
    ];

    protected array $messages = [
        'name.required' => 'Please tell us your name so we know who this beautiful wish is from! 💕',
        'name.min' => 'Your name should be at least 2 characters long.',
        'name.max' => 'Please keep your name under 255 characters.',
        'wish.required' => 'Please share your heartfelt wish for our special day! ✨',
        'wish.min' => 'Please share a wish that\'s at least 10 characters long.',
        'wish.max' => 'Please keep your wish under 1000 characters.',
    ];

    public function submitWish(): void
    {
        $this->validate();

        WeddingWish::create([
            'name' => trim($this->name),
            'wish' => trim($this->wish),
            'approved' => false, // Will be reviewed by admin
        ]);

        // Reset form
        $this->reset(['name', 'wish']);
        $this->showSuccessMessage = true;

        // Hide success message after 5 seconds
        $this->dispatch('wish-submitted');
    }

    public function render()
    {
        $approvedWishes = WeddingWish::where('approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.wishes-page', compact('approvedWishes'));
    }
}
