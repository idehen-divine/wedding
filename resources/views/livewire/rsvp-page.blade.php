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
                    <img src="{{ asset('assets/images/corner-1.png') }}" alt="Corner decoration" class="w-full h-full object-contain" loading="lazy">
                </div>
                <div class="absolute -bottom-4 -right-4 w-16 h-16 opacity-30 rotate-180">
                    <img src="{{ asset('assets/images/corner-2.png') }}" alt="Corner decoration" class="w-full h-full object-contain" loading="lazy">
                </div>

                @if (!$submitted)
                    <form wire:submit="submit" class="space-y-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" wire:model="name" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm @error('name') border-red-300 @enderror">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" wire:model="email" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm @error('email') border-red-300 @enderror">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Number of Guests <span class="text-red-500">*</span></label>
                            <select wire:model="guests"
                                class="w-full px-4 py-3 pr-8 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-colors text-sm @error('guests') border-red-300 @enderror">
                                <option value="1">1 Guest</option>
                                <option value="2">2 Guests</option>
                                <option value="3">3 Guests</option>
                                <option value="4">4 Guests</option>
                            </select>
                            @error('guests') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Will you be attending? <span class="text-red-500">*</span></label>
                            <div class="flex space-x-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model.live="attendance" value="yes" class="sr-only">
                                    <div class="w-5 h-5 border-2 border-primary rounded-full mr-2 flex items-center justify-center">
                                        <div class="w-2 h-2 bg-primary rounded-full transition-opacity {{ $attendance === 'yes' ? 'opacity-100' : 'opacity-0' }}"></div>
                                    </div>
                                    <span class="text-gray-700">Yes, I'll be there</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" wire:model.live="attendance" value="no" class="sr-only">
                                    <div class="w-5 h-5 border-2 border-primary rounded-full mr-2 flex items-center justify-center">
                                        <div class="w-2 h-2 bg-primary rounded-full transition-opacity {{ $attendance === 'no' ? 'opacity-100' : 'opacity-0' }}"></div>
                                    </div>
                                    <span class="text-gray-700">Sorry, can't make it</span>
                                </label>
                            </div>
                            @error('attendance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                        <p class="text-gray-600 mb-6">Your RSVP has been received. We can't wait to celebrate with you!</p>
                        <div class="flex flex-wrap justify-center gap-3">
                            <button onclick="window.open('https://calendar.google.com/calendar/render?action=TEMPLATE&text=Precious%20%26%20Franklin%20Wedding&dates=20250830T170000Z/20250830T230000Z&details=Join%20us%20for%20our%20special%20day!', '_blank')"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-button text-sm font-medium transition-colors whitespace-nowrap">
                                <i class="ri-google-line mr-1"></i>Add to Google
                            </button>
                            <button onclick="window.open('data:text/calendar;charset=utf8,BEGIN:VCALENDAR%0AVERSION:2.0%0ABEGIN:VEVENT%0ADTSTART:20250830T170000Z%0ADTEND:20250830T230000Z%0ASUMMARY:Precious & Franklin Wedding%0ADESCRIPTION:Join us for our special day!%0AEND:VEVENT%0AEND:VCALENDAR')"
                                class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-button text-sm font-medium transition-colors whitespace-nowrap">
                                <i class="ri-apple-line mr-1"></i>Add to Apple
                            </button>
                            <button onclick="window.open('https://outlook.live.com/calendar/0/deeplink/compose?subject=Precious%20%26%20Franklin%20Wedding&startdt=2025-08-30T17:00:00Z&enddt=2025-08-30T23:00:00Z&body=Join%20us%20for%20our%20special%20day!', '_blank')"
                                class="bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded-button text-sm font-medium transition-colors whitespace-nowrap">
                                <i class="ri-microsoft-line mr-1"></i>Add to Outlook
                            </button>
                        </div>
                        <button wire:click="resetForm"
                            class="mt-4 text-primary hover:text-primary/80 underline transition-colors">
                            Submit another RSVP
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <livewire:footer />
</div>
