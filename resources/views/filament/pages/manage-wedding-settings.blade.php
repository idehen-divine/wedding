<x-filament-panels::page>

    <form wire:submit="saveSettings">
        {{ $this->form }}

        <div class="fi-form-actions mt-8 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between gap-4">
                <!-- Delete Audio Button - Only show for non-protected files -->
                @php
                    $selectedMusic = $this->data['background_music'] ?? null;
                    $protectedFiles = [
                        'storage/audio/Harmony (Default).mp3',
                        'storage/audio/Until I Found You.mp3',
                    ];
                    $canDelete = $selectedMusic && !in_array($selectedMusic, $protectedFiles);
                @endphp
                
                @if($canDelete)
                    <x-filament::button 
                        wire:click="deleteAudioFile" 
                        color="danger" 
                        size="lg"
                        wire:confirm="Are you sure you want to delete this audio file? This action cannot be undone."
                    >
                        <x-slot name="icon">
                            <!-- Trash icon -->
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </x-slot>
                        Delete Audio File
                    </x-filament::button>
                @else
                    <div></div> <!-- Empty div to maintain spacing -->
                @endif

                <!-- Save Settings Button -->
                <x-filament::button type="submit" color="primary" size="lg">
                    <x-slot name="icon">
                        <!-- Loading spinner - shown when form is submitting -->
                        <svg wire:loading.delay wire:target="saveSettings" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <!-- Checkmark icon - shown when not loading -->
                        <svg wire:loading.remove wire:target="saveSettings" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </x-slot>
                    <!-- Loading text -->
                    <span wire:loading.delay wire:target="saveSettings">Saving...</span>
                    <!-- Default text -->
                    <span wire:loading.remove wire:target="saveSettings">Save Settings</span>
                </x-filament::button>
            </div>
        </div>
    </form>

    <!-- JavaScript for unsaved changes warning -->
    <script>
        document.addEventListener('livewire:init', function () {
            let formHasChanges = false;

            // Track form changes
            Livewire.hook('morph.updated', ({ el, component }) => {
                // Check if the component has any modified form fields
                formHasChanges = component.fingerprint.memo.data && 
                    Object.keys(component.fingerprint.memo.data).length > 0;
            });

            // Listen for form input changes
            document.addEventListener('input', function(e) {
                if (e.target.closest('form[wire\\:submit="saveSettings"]')) {
                    formHasChanges = true;
                }
            });

            // Add beforeunload warning for page close/refresh
            window.addEventListener('beforeunload', function (e) {
                if (formHasChanges) {
                    const message = 'You have unsaved changes. Are you sure you want to leave?';
                    e.preventDefault();
                    e.returnValue = message;
                    return message;
                }
            });

            // Add navigation warning for SPA navigation (links/buttons)
            document.addEventListener('click', function(e) {
                if (formHasChanges) {
                    // Check if clicking on navigation elements
                    const target = e.target.closest('a[href], button[type="button"]');
                    if (target && !target.closest('form[wire\\:submit="saveSettings"]')) {
                        if (!confirm('You have unsaved changes. Are you sure you want to leave?')) {
                            e.preventDefault();
                            e.stopPropagation();
                            return false;
                        }
                    }
                }
            });

            // Clear warning after form submission
            Livewire.on('saved', () => {
                formHasChanges = false;
            });
        });
    </script>
</x-filament-panels::page>