<div>
    <!-- RSVP Section -->
    <section class="pt-32 pb-20 px-6 bg-gradient-to-br from-white/40 to-primary/10">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="font-playfair text-4xl md:text-5xl font-light text-primary mb-4">RSVP</h1>
                <p class="text-gray-600 text-lg">Please let us know if you'll be joining us</p>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-lg relative">
                <!-- Decorative floral border -->
                <div class="absolute -top-4 -left-4 w-16 h-16 opacity-30">
                    <img src="{{ asset('assets/images/corner-1.png') }}" alt="Corner decoration"
                        class="w-full h-full object-contain" loading="lazy">
                </div>
                <div class="absolute -bottom-4 -right-4 w-16 h-16 opacity-30 rotate-180">
                    <img src="{{ asset('assets/images/corner-2.png') }}" alt="Corner decoration"
                        class="w-full h-full object-contain" loading="lazy">
                </div>

                @if (!$submitted)
                    <form class="space-y-6" novalidate x-data="{
                        name: @entangle('name'),
                        email: @entangle('email'),
                        whatsapp: @entangle('whatsapp'),
                        guests: @entangle('guests'),
                        attendance: @entangle('attendance'),
                        errors: {},

                        init() {
                            // Listen for Livewire events
                            this.$wire.on('rsvp-submitted', () => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'RSVP Sent Successfully!',
                                    text: 'Thank you for your response. We can\'t wait to celebrate with you!',
                                    confirmButtonColor: '#d97706',
                                    confirmButtonText: 'Great!'
                                });
                            });

                            this.$wire.on('rsvp-error', (message) => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: message || 'Something went wrong. Please try again.',
                                    confirmButtonColor: '#d97706'
                                });
                            });
                        },

                        validateName() {
                            if (!this.name || this.name.trim().length < 2) {
                                this.errors.name = 'Please enter your beautiful name so we can know you! 💕';
                            } else if (this.name.length > 255) {
                                this.errors.name = 'Whoa, that\'s a long name! Keep it under 255 characters please.';
                            } else {
                                delete this.errors.name;
                            }
                        },

                        validateEmail() {
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!this.email) {
                                this.errors.email = 'We need your email to keep in touch!';
                            } else if (!emailRegex.test(this.email)) {
                                this.errors.email = 'Hmm, that doesn\'t look like a real email address.';
                            } else if (this.email.length > 255) {
                                this.errors.email = 'That email is too long! Keep it under 255 characters.';
                            } else {
                                delete this.errors.email;
                            }
                        },

                        validateWhatsapp() {
                            if (this.whatsapp && this.whatsapp.trim()) {
                                const whatsappRegex = /^[\+]?[0-9\s\-\(\)]{10,20}$/;
                                if (!whatsappRegex.test(this.whatsapp)) {
                                    this.errors.whatsapp = 'Please enter a valid WhatsApp number (10-20 digits) 📱';
                                } else if (this.whatsapp.length > 20) {
                                    this.errors.whatsapp = 'WhatsApp number is too long! Keep it under 20 characters.';
                                } else {
                                    delete this.errors.whatsapp;
                                }
                            } else {
                                delete this.errors.whatsapp;
                            }
                        },

                        validateGuests() {
                            if (!this.guests) {
                                this.errors.guests = 'How many lovely people are you bringing?';
                            } else if (!['1', '2', '3', '4'].includes(this.guests)) {
                                this.errors.guests = 'Please pick between 1-4 guests (we wish we could have more!).';
                            } else {
                                delete this.errors.guests;
                            }
                        },

                        validateAttendance() {
                            if (!this.attendance) {
                                this.errors.attendance = 'Will we see your beautiful face on our special day?';
                            } else if (!['yes', 'no'].includes(this.attendance)) {
                                this.errors.attendance = 'Just pick yes or no - we promise we won\'t be offended! 😊';
                            } else {
                                delete this.errors.attendance;
                            }
                        },

                        validateAll() {
                            this.validateName();
                            this.validateEmail();
                            this.validateWhatsapp();
                            this.validateGuests();
                            this.validateAttendance();
                            return Object.keys(this.errors).length === 0;
                        },

                        submitForm() {
                            if (this.validateAll()) {
                                Swal.fire({
                                    title: 'Sending RSVP...',
                                    text: 'Please wait while we process your response',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                                // Call Livewire method directly
                                this.$wire.submit();
                            }
                        }
                    }" @submit.prevent="submitForm()">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Full Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" wire:model="name" required @input="validateName()"
                                @blur="validateName()"
                                :class="{ 'border-red-300': errors.name, 'border-green-300': name && !errors.name }"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm">
                            <span x-show="errors.name" x-text="errors.name" class="text-red-500 text-sm"
                                x-transition></span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Email Address <span
                                    class="text-red-500">*</span></label>
                            <input type="email" wire:model="email" required @input="validateEmail()"
                                @blur="validateEmail()"
                                :class="{ 'border-red-300': errors.email, 'border-green-300': email && !errors.email }"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm">
                            <span x-show="errors.email" x-text="errors.email" class="text-red-500 text-sm"
                                x-transition></span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">WhatsApp Number
                                <span class="text-gray-500 text-sm">(optional)</span></label>
                            <input type="tel" wire:model="whatsapp" @input="validateWhatsapp()"
                                @blur="validateWhatsapp()" placeholder="+234 123 456 7890"
                                :class="{ 'border-red-300': errors.whatsapp, 'border-green-300': whatsapp && !errors.whatsapp }"
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm">
                            <span x-show="errors.whatsapp" x-text="errors.whatsapp" class="text-red-500 text-sm"
                                x-transition></span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Number of Guests <span
                                    class="text-red-500">*</span></label>
                            <select wire:model="guests" @change="validateGuests()"
                                :class="{ 'border-red-300': errors.guests, 'border-green-300': guests && !errors.guests }"
                                class="w-full px-4 py-3 pr-8 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm">
                                <option value="">Select number of guests</option>
                                <option value="1">1 Guest</option>
                                <option value="2">2 Guests</option>
                                <option value="3">3 Guests</option>
                                <option value="4">4 Guests</option>
                            </select>
                            <span x-show="errors.guests" x-text="errors.guests" class="text-red-500 text-sm"
                                x-transition></span>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Will you be attending? <span
                                    class="text-red-500">*</span></label>
                            <div class="flex space-x-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model="attendance" value="yes" class="hidden"
                                        @change="attendance = 'yes'; validateAttendance()">
                                    <div
                                        class="w-5 h-5 border-2 border-primary rounded-full mr-2 flex items-center justify-center">
                                        <div class="w-2 h-2 bg-primary rounded-full transition-opacity"
                                            :class="attendance === 'yes' ? 'opacity-100' : 'opacity-0'"></div>
                                    </div>
                                    <span class="text-gray-700">Yes, I'll be there</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model="attendance" value="no" class="hidden"
                                        @change="attendance = 'no'; validateAttendance()">
                                    <div
                                        class="w-5 h-5 border-2 border-primary rounded-full mr-2 flex items-center justify-center">
                                        <div class="w-2 h-2 bg-primary rounded-full transition-opacity"
                                            :class="attendance === 'no' ? 'opacity-100' : 'opacity-0'"></div>
                                    </div>
                                    <span class="text-gray-700">Sorry, can't make it</span>
                                </label>
                            </div>
                            <span x-show="errors.attendance" x-text="errors.attendance" class="text-red-500 text-sm"
                                x-transition></span>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary hover:bg-primary/90 text-white py-3 rounded-button font-medium transition-colors whitespace-nowrap">
                            Send RSVP
                        </button>
                    </form>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 flex items-center justify-center bg-green-100 rounded-full mx-auto mb-4">
                            <i class="ri-check-line text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="font-playfair text-2xl font-medium text-primary mb-2">Thank You!</h3>
                        <p class="text-gray-600 mb-6">Your RSVP has been received. We can't wait to celebrate with you!
                        </p>
                        <div class="flex flex-wrap justify-center gap-3">
                            <button
                                onclick="window.open('https://calendar.google.com/calendar/render?action=TEMPLATE&text=Precious%20%26%20Franklin%20Wedding&dates=20250830T170000Z/20250830T230000Z&details=Join%20us%20for%20our%20special%20day!', '_blank')"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-button text-sm font-medium transition-colors whitespace-nowrap">
                                <i class="ri-google-line mr-1"></i>Add to Google
                            </button>
                            <button
                                onclick="window.open('data:text/calendar;charset=utf8,BEGIN:VCALENDAR%0AVERSION:2.0%0ABEGIN:VEVENT%0ADTSTART:20250830T170000Z%0ADTEND:20250830T230000Z%0ASUMMARY:Precious & Franklin Wedding%0ADESCRIPTION:Join us for our special day!%0AEND:VEVENT%0AEND:VCALENDAR')"
                                class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-button text-sm font-medium transition-colors whitespace-nowrap">
                                <i class="ri-apple-line mr-1"></i>Add to Apple
                            </button>
                            <button
                                onclick="window.open('https://outlook.live.com/calendar/0/deeplink/compose?subject=Precious%20%26%20Franklin%20Wedding&startdt=2025-08-30T17:00:00Z&enddt=2025-08-30T23:00:00Z&body=Join%20us%20for%20our%20special%20day!', '_blank')"
                                class="bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded-button text-sm font-medium transition-colors whitespace-nowrap">
                                <i class="ri-microsoft-line mr-1"></i>Add to Outlook
                            </button>
                        </div>
                        <button
                            @click="
                                Swal.fire({
                                    title: 'Loading form...',
                                    text: 'Please wait',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    showConfirmButton: false,
                                    didOpen: () => { Swal.showLoading(); }
                                });
                                $wire.resetForm().then(() => {
                                    Swal.close();
                                });
                            "
                            class="mt-4 text-primary hover:text-primary/80 underline transition-colors">
                            Submit another RSVP
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('partials.footer')
</div>
