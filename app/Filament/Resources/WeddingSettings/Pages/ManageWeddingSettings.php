<?php

namespace App\Filament\Resources\WeddingSettings\Pages;

use App\Filament\Resources\WeddingSettings\WeddingSettingResource;
use App\Models\WeddingSetting;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ManageWeddingSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = WeddingSettingResource::class;

    protected string $view = 'filament.pages.manage-wedding-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->fillForm();
    }

    public function fillForm(): void
    {
        $settings = WeddingSetting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('General Settings')
                    ->description('Basic wedding information')
                    ->collapsible()
                    ->schema([
                        TextInput::make('bride_name')
                            ->label('Bride Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('groom_name')
                            ->label('Groom Name')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('wedding_date')
                            ->label('Wedding Date')
                            ->required()
                            ->format('Y-m-d'),
                        TextInput::make('wedding_hashtag')
                            ->label('Wedding Hashtag')
                            ->required()
                            ->maxLength(255)
                            ->prefix('#'),
                        Textarea::make('footer_tagline')
                            ->label('Footer Tagline')
                            ->required()
                            ->rows(2)
                            ->maxLength(500),
                        TextInput::make('dress_code_title')
                            ->label('Dress Code Title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('dress_code_description')
                            ->label('Dress Code Description')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('dress_code_colors')
                            ->label('Preferred Colors')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Ceremony Details')
                    ->description('Wedding ceremony information')
                    ->collapsible()
                    ->schema([
                        TextInput::make('ceremony_name')
                            ->label('Venue Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('ceremony_address')
                            ->label('Address')
                            ->required()
                            ->maxLength(255),
                        TimePicker::make('ceremony_time')
                            ->label('Time')
                            ->required()
                            ->format('H:i')
                            ->displayFormat('h:i A'),
                    ])
                    ->columns(2),

                Section::make('Reception Details')
                    ->description('Wedding reception information')
                    ->collapsible()
                    ->schema([
                        TextInput::make('reception_name')
                            ->label('Venue Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('reception_address')
                            ->label('Address')
                            ->required()
                            ->maxLength(255),
                        TimePicker::make('reception_start_time')
                            ->label('Start Time')
                            ->required()
                            ->format('H:i')
                            ->displayFormat('h:i A'),
                        TimePicker::make('reception_end_time')
                            ->label('End Time')
                            ->required()
                            ->format('H:i')
                            ->displayFormat('h:i A'),
                    ])
                    ->columns(2),

                Section::make('Contact Information')
                    ->description('Contact details for guests')
                    ->collapsible()
                    ->schema([
                        TextInput::make('contact_email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('contact_phone')
                            ->label('Phone Number')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Social Media')
                    ->description('Social media profile links')
                    ->collapsible()
                    ->schema([
                        TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->nullable()
                            ->maxLength(255),
                        TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->nullable()
                            ->maxLength(255),
                        TextInput::make('twitter_url')
                            ->label('Twitter URL')
                            ->nullable()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Music')
                    ->description('Background music settings')
                    ->collapsible()
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)
                            ->extraAttributes(['class' => 'gap-6 items-stretch'])
                            ->schema([
                                // Select Column
                                \Filament\Schemas\Components\Fieldset::make('Select from Library')
                                    ->extraAttributes(['class' => 'h-full w-full'])
                                    ->schema([
                                        Select::make('background_music')
                                            ->label('Choose Audio File')
                                            ->columnSpanFull()
                                            ->options(function () {
                                                $audioFiles = [];

                                                // Scan storage/audio directory for all files
                                                $storageAudioPath = storage_path('app/public/audio');
                                                if (\File::exists($storageAudioPath)) {
                                                    $files = \File::files($storageAudioPath);
                                                    foreach ($files as $file) {
                                                        if (in_array($file->getExtension(), ['mp3', 'wav', 'ogg'])) {
                                                            $relativePath = 'storage/audio/'.$file->getFilename();
                                                            $fileName = pathinfo($file->getFilename(), PATHINFO_FILENAME);
                                                            $audioFiles[$relativePath] = ucfirst(str_replace(['-', '_'], ' ', $fileName));
                                                        }
                                                    }
                                                }

                                                return $audioFiles;
                                            })
                                            ->required()
                                            ->live()
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                // Clear upload field when selecting from dropdown
                                                $set('pending_upload', null);
                                            })
                                            ->extraAttributes([
                                                'x-data' => '{}',
                                                // Keep x-init minimal to avoid Alpine expression parsing issues
                                                'x-init' => 'window.weddingAudio = window.weddingAudio || window.weddingAudio',
                                                // Single-line, comment-free expression to avoid Alpine AsyncFunction parse errors
                                                'x-on:change' => "document.querySelectorAll('audio').forEach(function(a){a.pause();a.currentTime=0;});try{if(window.weddingAudio && window.weddingAudio.setLoading)window.weddingAudio.setLoading(\$event.target.value);}catch(e){};try{setTimeout(function(){if(window.weddingAudio && window.weddingAudio.setSelected)window.weddingAudio.setSelected(\$event.target.value);},250);}catch(e){}",
                                            ]),
                                    ]),

                                // Preview Column
                                \Filament\Schemas\Components\Fieldset::make('Preview')
                                    ->extraAttributes(['class' => 'h-full w-full'])
                                    ->schema([
                                        Placeholder::make('current_preview')
                                            ->hiddenLabel()
                                            ->columnSpanFull()
                                            ->content(function (callable $get) {
                                                $selectedFile = $get('background_music');
                                                if (! $selectedFile) {
                                                    return new \Illuminate\Support\HtmlString('<div class="text-gray-500 italic text-sm">Select a file to preview</div>');
                                                }

                                                $audioUrl = asset($selectedFile);
                                                $fileName = basename($selectedFile);
                                                $audioId = 'audio-preview-'.md5($selectedFile);

                                                return view('filament.partials.music-preview', compact('audioUrl', 'fileName', 'audioId'));
                                            }),
                                    ]),
                            ]),

                        \Filament\Schemas\Components\Fieldset::make('Upload New File')
                            ->schema([
                                FileUpload::make('pending_upload')
                                    ->label('Choose File to Upload')
                                    ->columnSpanFull()
                                    ->directory('temp-audio')
                                    ->disk('public')
                                    ->acceptedFileTypes(['audio/mpeg', 'audio/wav', 'audio/ogg'])
                                    ->maxSize(10240) // 10MB
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        // Clear selection when uploading new file
                                        if ($state) {
                                            $set('background_music', null);
                                        }
                                    }),

                                Placeholder::make('upload_actions')
                                    ->hiddenLabel()
                                    ->columnSpanFull()
                                    ->content(function (callable $get) {
                                        $uploadedFile = $get('pending_upload');
                                        if (! $uploadedFile) {
                                            return '';
                                        }

                                        return new \Illuminate\Support\HtmlString('
                                            <div class="flex gap-2 mt-2">
                                                <button type="button" wire:click="confirmUpload" wire:loading.attr="disabled" wire:target="confirmUpload"
                                                    class="px-3 py-2 bg-green-600 hover:bg-green-700 disabled:bg-green-400 disabled:cursor-not-allowed text-white rounded-md text-sm font-medium transition-colors flex items-center gap-2">
                                                    <svg wire:loading wire:target="confirmUpload" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    <span wire:loading.remove wire:target="confirmUpload">Use This File</span>
                                                    <span wire:loading wire:target="confirmUpload">Processing...</span>
                                                </button>
                                                <button type="button" wire:click="cancelUpload" wire:loading.attr="disabled" wire:target="confirmUpload"
                                                    class="px-3 py-2 bg-gray-600 hover:bg-gray-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white rounded-md text-sm font-medium transition-colors">
                                                    Cancel
                                                </button>
                                            </div>
                                       ');
                                    }),
                            ]),

                    ]),

                Section::make('Gallery Settings')
                    ->description('Control gallery visibility and publishing')
                    ->collapsible()
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                // Status Column
                                \Filament\Schemas\Components\Fieldset::make('Gallery Status')
                                    ->schema([
                                        \Filament\Forms\Components\Toggle::make('gallery_published')
                                            ->label('Gallery Published')
                                            ->helperText('Toggle to publish or unpublish the photo gallery for guests')
                                            ->onColor('success')
                                            ->offColor('gray')
                                            ->live()
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                // Auto-save the setting when toggled
                                                WeddingSetting::where('key', 'gallery_published')
                                                    ->update(['value' => $state ? '1' : '0']);

                                                Notification::make()
                                                    ->title($state ? 'Gallery Published!' : 'Gallery Unpublished')
                                                    ->body($state
                                                        ? 'The photo gallery is now visible to guests.'
                                                        : 'The photo gallery is now hidden from guests.')
                                                    ->success()
                                                    ->send();
                                            }),
                                    ]),

                                // Actions Column
                                \Filament\Schemas\Components\Fieldset::make('Gallery Actions')
                                    ->schema([
                                        Placeholder::make('gallery_actions')
                                            ->hiddenLabel()
                                            ->content(function (callable $get) {
                                                $isPublished = $get('gallery_published');
                                                $publishText = $isPublished ? 'Published' : 'Coming Soon';
                                                $statusColor = $isPublished ? 'text-green-600' : 'text-gray-500';

                                                return new \Illuminate\Support\HtmlString('
                                                    <div class="space-y-3">
                                                        <div class="flex items-center gap-2">
                                                            <div class="w-3 h-3 rounded-full '.($isPublished ? 'bg-green-500' : 'bg-gray-400').'"></div>
                                                            <span class="font-medium '.$statusColor.'">'.$publishText.'</span>
                                                        </div>
                                                        <p class="text-sm text-gray-600">
                                                            '.($isPublished
                                                                ? 'Guests can now view the photo gallery page.'
                                                                : 'Guests will see a "Coming Soon" message.').'
                                                        </p>
                                                        <div class="pt-2">
                                                            <a href="/gallery" target="_blank"
                                                               class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 underline">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002 2v-2M17 6l5 5-5 5M8 14l9-9"/>
                                                                </svg>
                                                                View Gallery Page
                                                            </a>
                                                        </div>
                                                    </div>
                                                ');
                                            }),
                                    ]),
                            ]),
                    ]),
            ])
            ->statePath('data')
            ->model(WeddingSetting::class);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function saveSettings()
    {
        try {
            // Validate the form first
            $data = $this->form->getState();

            // Save each setting
            foreach ($data as $key => $value) {
                $settingValue = $value === null ? '' : $value;
                WeddingSetting::where('key', $key)->update([
                    'value' => $settingValue,
                ]);
            }

            Notification::make()
                ->title('Settings saved successfully!')
                ->success()
                ->send();

        } catch (\Exception $e) {
            // Log the actual error for debugging
            \Log::error('Settings save error: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            Notification::make()
                ->title('Error saving settings')
                ->body('Error: '.$e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function confirmUpload()
    {
        try {
            // Get form data without validation to avoid the required field error
            $formData = $this->form->getRawState();
            $pendingFile = $formData['pending_upload'] ?? null;

            // Debug logging
            \Log::info('Upload confirmation debug', [
                'pending_file' => $pendingFile,
                'form_data_keys' => array_keys($formData),
            ]);

            // Also log to browser console
            $this->js('console.log("Upload debug:", '.json_encode([
                'pending_file' => $pendingFile,
                'form_data_keys' => array_keys($formData),
            ]).')');

            if (! $pendingFile) {
                Notification::make()
                    ->title('No file to confirm')
                    ->warning()
                    ->send();

                return;
            }

            // Handle the file name properly - it's a TemporaryUploadedFile object
            if (is_array($pendingFile)) {
                $tempUploadedFile = reset($pendingFile); // Get first value from array regardless of key
            } else {
                $tempUploadedFile = $pendingFile;
            }

            // Get the original filename and temp path from the TemporaryUploadedFile
            $originalFileName = $tempUploadedFile->getClientOriginalName();
            $tempPath = $tempUploadedFile->getRealPath();
            $finalPath = storage_path('app/public/audio/'.basename($originalFileName));

            \Log::info('File path debug', [
                'originalFileName' => $originalFileName,
                'tempPath' => $tempPath,
                'finalPath' => $finalPath,
                'tempExists' => \File::exists($tempPath),
                'tempUploadedFile' => get_class($tempUploadedFile),
            ]);

            $this->js('console.log("File path debug:", '.json_encode([
                'originalFileName' => $originalFileName,
                'tempPath' => $tempPath,
                'finalPath' => $finalPath,
                'tempExists' => \File::exists($tempPath),
            ]).')');

            // Move file from temp to permanent location
            if (\File::exists($tempPath)) {
                // Ensure audio directory exists
                $audioDir = storage_path('app/public/audio');
                if (! \File::exists($audioDir)) {
                    \File::makeDirectory($audioDir, 0755, true);
                }

                \File::move($tempPath, $finalPath);

                // Update the form with the new file - use fill to set the state properly
                $newPath = 'storage/audio/'.basename($originalFileName);
                $this->form->fill([
                    'background_music' => $newPath,
                    'pending_upload' => null,
                ]);

                // Also update the wedding setting in the database
                WeddingSetting::where('key', 'background_music')->update([
                    'value' => $newPath,
                ]);

                // Trigger form refresh to update select dropdown and preview
                $this->dispatch('$refresh');

                Notification::make()
                    ->title('Audio file uploaded successfully!')
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('Upload failed')
                    ->body('The uploaded file could not be found.')
                    ->danger()
                    ->send();
            }
        } catch (\Exception $e) {
            \Log::error('Audio upload confirmation error: '.$e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            // Also log to browser console for debugging
            $this->js('console.error("Upload error: " + '.json_encode($e->getMessage()).', '.json_encode([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]).')');

            Notification::make()
                ->title('Error confirming upload')
                ->body('Error: '.$e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function cancelUpload()
    {
        try {
            $data = $this->form->getState();
            $pendingFile = $data['pending_upload'] ?? null;

            if ($pendingFile) {
                // Handle the file name properly - it's an object with UUID keys
                if (is_array($pendingFile)) {
                    $fileName = reset($pendingFile); // Get first value from array regardless of key
                } else {
                    $fileName = $pendingFile;
                }
                $tempPath = storage_path('app/public/temp-audio/'.basename($fileName));

                // Delete the temporary file
                if (\File::exists($tempPath)) {
                    \File::delete($tempPath);
                }
            }

            // Clear the upload field
            $this->form->fill(['pending_upload' => null]);

            Notification::make()
                ->title('Upload cancelled')
                ->success()
                ->send();
        } catch (\Exception $e) {
            \Log::error('Audio upload cancellation error: '.$e->getMessage());
        }
    }

    public function deleteAudioFile()
    {
        try {
            // Get form data without validation to avoid required field errors
            $data = $this->form->getRawState();
            $selectedFile = $data['background_music'] ?? null;

            if (! $selectedFile) {
                Notification::make()
                    ->title('No file selected')
                    ->warning()
                    ->send();

                return;
            }

            // Protect default files
            $protectedFiles = [
                'storage/audio/Harmony (Default).mp3',
                'storage/audio/Until I Found You.mp3',
            ];

            if (in_array($selectedFile, $protectedFiles)) {
                Notification::make()
                    ->title('Cannot delete default files')
                    ->body('Default audio files are protected and cannot be deleted.')
                    ->warning()
                    ->send();

                return;
            }

            // Extract filename and delete from storage
            $fileName = basename($selectedFile);
            $filePath = storage_path('app/public/audio/'.$fileName);

            if (\File::exists($filePath)) {
                \File::delete($filePath);

                // Reset to no selection (empty) after deletion
                $this->form->fill(['background_music' => null]);

                // Also update the wedding setting in the database to empty
                WeddingSetting::where('key', 'background_music')->update([
                    'value' => '',
                ]);

                // Trigger form refresh to update select dropdown and preview
                $this->dispatch('$refresh');

                Notification::make()
                    ->title('Audio file deleted')
                    ->body('The audio file has been deleted successfully.')
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('File not found')
                    ->body('The selected file could not be found.')
                    ->warning()
                    ->send();
            }
        } catch (\Exception $e) {
            \Log::error('Audio delete error: '.$e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            // Also log to browser console for debugging
            $this->js('console.error("Delete error: " + '.json_encode($e->getMessage()).', '.json_encode([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]).')');

            Notification::make()
                ->title('Error deleting file')
                ->body('Error: '.$e->getMessage())
                ->danger()
                ->send();
        }
    }
}
