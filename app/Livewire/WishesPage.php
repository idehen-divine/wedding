<?php

namespace App\Livewire;

use App\Models\WeddingWish;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('components.layouts.wedding')]
class WishesPage extends Component
{
    use WithoutUrlPagination, WithPagination;

    public string $name = '';

    public string $wish = '';

    public function submitWish(): void
    {
        try {
            if (empty(trim($this->name)) || empty(trim($this->wish))) {
                $this->dispatch('wish-error', 'Please fill in all required fields.');

                return;
            }

            $this->validate([
                'name' => 'required|string|min:2|max:255',
                'wish' => 'required|string|min:10|max:1000',
            ]);

            WeddingWish::create([
                'name' => trim($this->name),
                'wish' => trim($this->wish),
                'approved' => true,
            ]);

            $this->reset(['name', 'wish']);
            $this->resetPage();
            $this->dispatch('wish-submitted');
            session()->flash('wish_success', 'Thank you for your beautiful wish! It has been added.');
        } catch (\Exception $e) {
            $this->dispatch('wish-error', 'Something went wrong. Please try again.');
        }
    }

    public function render()
    {
        $approvedWishes = WeddingWish::where('approved', true)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('livewire.wishes-page', [
            'approvedWishes' => $approvedWishes,
        ]);
    }
}
