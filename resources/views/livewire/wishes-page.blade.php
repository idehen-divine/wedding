<div x-data="{
    showModal: false,
    name: '',
    wish: '',
    errors: {},
    isSubmitting: false,

    init() {
        // Listen for Livewire events
        this.$wire.on('wish-submitted', () => {
            this.isSubmitting = false;
            // Show success message
            Swal.fire({
                title: 'Thank you! 💕',
                text: 'Your beautiful wish has been submitted.',
                icon: 'success',
                confirmButtonText: 'Close',
                confirmButtonColor: '#D4A574'
            }).then(() => {
                // Reset form
                this.name = '';
                this.wish = '';
                this.errors = {};
                this.showModal = false;
            });
        });

        this.$wire.on('wish-error', (message) => {
            this.isSubmitting = false;
            // Show error message
            Swal.fire({
                title: 'Oops!',
                text: message || 'Something went wrong. Please try again.',
                icon: 'error',
                confirmButtonText: 'Try Again',
                confirmButtonColor: '#D4A574'
            });
        });
    },

    validateName() {
        // Only validate on blur - check if name is too short
        if (this.name.trim().length > 0 && this.name.trim().length < 3) {
            this.errors.name = 'Your name seems a bit short. Could you share a bit more? 😊';
        } else if (this.name.length > 255) {
            this.errors.name = 'Please keep your name under 255 characters.';
        } else {
            delete this.errors.name;
        }
    },

    validateWish() {
        // Only validate on blur - check if wish is too short
        if (this.wish.trim().length > 0 && this.wish.trim().length < 10) {
            this.errors.wish = 'Please share a bit more of your heartfelt wish! ✨';
        } else if (this.wish.length > 1000) {
            this.errors.wish = 'Please keep your wish under 1000 characters.';
        } else {
            delete this.errors.wish;
        }
    },

    // Validation for form submission - stricter checks
    validateAll() {
        // Clear existing errors first
        this.errors = {};

        // Check name
        if (!this.name || this.name.trim().length < 2) {
            this.errors.name = 'Please tell us your name so we know who this beautiful wish is from! 💕';
        } else if (this.name.length > 255) {
            this.errors.name = 'Please keep your name under 255 characters.';
        }

        // Check wish
        if (!this.wish || this.wish.trim().length < 10) {
            this.errors.wish = 'Please share a heartfelt wish that\'s at least 10 characters long! ✨';
        } else if (this.wish.length > 1000) {
            this.errors.wish = 'Please keep your wish under 1000 characters.';
        }

        return Object.keys(this.errors).length === 0;
    },

    submitForm() {
        if (this.validateAll()) {
            this.isSubmitting = true;

            // Close the modal first
            this.showModal = false;

            // Show loading animation
            Swal.fire({
                title: 'Sending your wish...',
                text: 'Please wait while we share your beautiful message',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Update Livewire properties and call method
            $wire.name = this.name;
            $wire.wish = this.wish;
            $wire.submitWish();
        }
    },

    resetForm() {
        this.name = '';
        this.wish = '';
        this.errors = {};
        this.isSubmitting = false;
    }
}">

    <!-- Guest Wishes Section -->
    <section class="pt-32 pb-20 px-6 bg-gradient-to-br from-white/40 to-primary/10">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="font-playfair text-4xl md:text-5xl font-light text-primary mb-4">Guest Wishes</h1>
                <p class="text-gray-600 text-lg">Share your congratulations and well wishes for our special day</p>
            </div>

            <!-- Display Approved Wishes -->
            <div class="grid md:grid-cols-2 gap-6 mb-12">
                @forelse($approvedWishes as $wish)
                    <div
                        class="bg-gradient-to-br from-white/80 to-primary/10 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center">
                                <span class="text-primary font-medium">
                                    {{ strtoupper(substr($wish->name, 0, 1)) }}{{ strlen($wish->name) > 1 ? strtoupper(substr(explode(' ', $wish->name)[1] ?? explode(' ', $wish->name)[0], 1, 1)) : '' }}
                                </span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800 mb-1">{{ $wish->name }}</h4>
                                <p class="text-gray-600 text-sm mb-2">{{ $wish->created_at->diffForHumans() }}</p>
                                <p class="text-gray-700">"{{ $wish->wish }}"</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 text-center py-12">
                        <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="ri-heart-line text-3xl text-primary/60"></i>
                        </div>
                        <h3 class="font-medium text-gray-800 mb-2">No wishes yet</h3>
                        <p class="text-gray-600">Be the first to share your congratulations!</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center">
                <button @click="resetForm(); showModal = true"
                    class="bg-primary hover:bg-primary/90 text-white px-8 py-3 rounded-button font-medium transition-colors whitespace-nowrap">
                    <i class="ri-heart-line mr-2"></i>Add Your Wish
                </button>
            </div>
        </div>

        <!-- Add Wish Modal -->
        <div x-show="showModal" x-cloak
            class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-6"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="bg-white rounded-2xl p-8 max-w-md w-full" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90" @click.outside="resetForm(); showModal = false">
                <h3 class="font-playfair text-2xl font-medium text-primary mb-6">Share Your Wishes</h3>

                <form @submit.prevent="submitForm()" class="space-y-4">
                    <!-- Name Field -->
                    <div>
                        <input type="text" x-model="name" @blur="validateName()"
                            :class="{ 'border-red-300': errors.name, 'border-green-300': name && !errors.name }"
                            placeholder="Your Name"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm">
                        <span x-show="errors.name" x-text="errors.name"
                            class="text-red-500 text-xs mt-1 flex items-center" x-transition>
                            <i class="ri-error-warning-line mr-1"></i>
                        </span>
                    </div>

                    <!-- Wish Field -->
                    <div>
                        <textarea rows="4" x-model="wish" @blur="validateWish()"
                            :class="{ 'border-red-300': errors.wish, 'border-green-300': wish && !errors.wish }"
                            placeholder="Your heartfelt message for the couple..."
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm"></textarea>
                        <span x-show="errors.wish" x-text="errors.wish"
                            class="text-red-500 text-xs mt-1 flex items-center" x-transition>
                            <i class="ri-error-warning-line mr-1"></i>
                        </span>
                        <p class="text-gray-500 text-xs mt-1" x-text="`${wish.length}/1000 characters`"></p>
                    </div>

                    <div class="flex space-x-4">
                        <button type="button" @click="resetForm(); showModal = false"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-3 rounded-button font-medium transition-colors whitespace-nowrap">
                            Cancel
                        </button>
                        <button type="submit"
                            :disabled="Object.keys(errors).length > 0 || !name || !wish || isSubmitting"
                            :class="{
                                'opacity-50 cursor-not-allowed': Object.keys(errors).length > 0 || !name || !wish ||
                                    isSubmitting
                            }"
                            class="flex-1 bg-primary hover:bg-primary/90 text-white py-3 rounded-button font-medium transition-colors whitespace-nowrap">
                            <span x-show="!isSubmitting">Share Wish</span>
                            <span x-show="isSubmitting" class="flex items-center justify-center">
                                <i class="ri-loader-4-line animate-spin mr-2"></i>
                                Sending...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @include('partials.footer')
</div>
