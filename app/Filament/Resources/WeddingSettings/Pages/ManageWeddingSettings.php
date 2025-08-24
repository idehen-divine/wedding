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
                                                'onchange' => "
                                                    // Immediately stop all playing audio when selection changes
                                                    document.querySelectorAll('audio').forEach(function(audio) {
                                                        audio.pause();
                                                        audio.currentTime = 0;
                                                    });
                                                ",
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
                                                    return '<div class="text-gray-500 italic text-sm">Select a file to preview</div>';
                                                }

                                                $audioUrl = asset($selectedFile);
                                                $fileName = basename($selectedFile);
                                                $audioId = 'audio-preview-'.md5($selectedFile);

                                                return new \Illuminate\Support\HtmlString("
                                                    <div class='border rounded-lg p-3 bg-gray-50 dark:bg-gray-800'>
                                                        <div class='text-sm font-medium text-gray-900 dark:text-gray-100 mb-2'>{$fileName}</div>
                                                        <audio id='{$audioId}' controls class='w-full' preload='metadata'>
                                                            <source src='{$audioUrl}' type='audio/mpeg'>
                                                            Your browser does not support the audio element.
                                                        </audio>
                                                    </div>

                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            const currentAudio = document.getElementById('{$audioId}');
                                                            if (currentAudio) {
                                                                currentAudio.addEventListener('play', function() {
                                                                    document.querySelectorAll('audio').forEach(function(audio) {
                                                                        if (audio !== currentAudio) {
                                                                            audio.pause();
                                                                            audio.currentTime = 0;
                                                                        }
                                                                    });
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                ");
                                            }),
                                    ]),
                            ]),

                        \Filament\Schemas\Components\Grid::make(2)
                            ->extraAttributes(['class' => 'gap-6 items-stretch'])
                            ->schema([
                                // Upload Column
                                \Filament\Schemas\Components\Fieldset::make('Upload New File')
                                    ->extraAttributes(['class' => 'h-full w-full'])
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
                                    ]),

                                // Upload Preview Column
                                \Filament\Schemas\Components\Fieldset::make('Upload Preview')
                                    ->extraAttributes(['class' => 'h-full w-full'])
                                    ->schema([
                                        Placeholder::make('upload_preview')
                                            ->hiddenLabel()
                                            ->columnSpanFull()
                                            ->content(function (callable $get) {
                                                $uploadedFile = $get('pending_upload');
                                                if (! $uploadedFile) {
                                                    return '<div class="text-gray-500 italic text-sm">Upload a file to preview</div>';
                                                }

                                                $fileName = is_array($uploadedFile) ? $uploadedFile[0] : $uploadedFile;
                                                $audioUrl = asset('storage/temp-audio/'.basename($fileName));
                                                $displayName = basename($fileName);
                                                $audioId = 'audio-upload-'.md5($fileName);

                                                return new \Illuminate\Support\HtmlString("
                                                    <div class='border rounded-lg p-3 bg-blue-50 dark:bg-blue-900'>
                                                        <div class='flex items-center justify-between mb-2'>
                                                            <span class='text-sm font-medium text-gray-900 dark:text-gray-100'>{$displayName}</span>
                                                            <span class='text-xs text-blue-600 dark:text-blue-400'>Preview</span>
                                                        </div>
                                                        <audio id='{$audioId}' controls class='w-full mb-3' preload='metadata'>
                                                            <source src='{$audioUrl}' type='audio/mpeg'>
                                                            Your browser does not support the audio element.
                                                        </audio>
                                                        <div class='flex gap-2'>
                                                            <button type='button' onclick='confirmUpload()' class='px-2 py-1 bg-green-600 text-white rounded text-xs hover:bg-green-700'>
                                                                Use This File
                                                            </button>
                                                            <button type='button' onclick='cancelUpload()' class='px-2 py-1 bg-gray-600 text-white rounded text-xs hover:bg-gray-700'>
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        function confirmUpload() {
                                                            \$wire.confirmUpload();
                                                        }
                                                        function cancelUpload() {
                                                            \$wire.cancelUpload();
                                                        }
                                                    </script>
                                                ");
                                            }),
                                    ]),
                            ]),

                    ])
                    ->columns(1),
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
                // Handle empty values properly
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
            $data = $this->form->getState();
            $pendingFile = $data['pending_upload'] ?? null;

            if (! $pendingFile) {
                Notification::make()
                    ->title('No file to confirm')
                    ->warning()
                    ->send();

                return;
            }

            $fileName = is_array($pendingFile) ? $pendingFile[0] : $pendingFile;
            $tempPath = storage_path('app/public/temp-audio/'.basename($fileName));
            $finalPath = storage_path('app/public/audio/'.basename($fileName));

            // Move file from temp to permanent location
            if (\File::exists($tempPath)) {
                \File::move($tempPath, $finalPath);

                // Update the form with the new file
                $this->form->fill([
                    'background_music' => 'storage/audio/'.basename($fileName),
                    'pending_upload' => null,
                ]);

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
            \Log::error('Audio upload confirmation error: '.$e->getMessage());

            Notification::make()
                ->title('Error confirming upload')
                ->body('An error occurred while processing the upload.')
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
                $fileName = is_array($pendingFile) ? $pendingFile[0] : $pendingFile;
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
            $data = $this->form->getState();
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

                // Reset to default if this was the selected file
                $this->form->fill(['background_music' => 'storage/audio/Harmony (Default).mp3']);

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
            \Log::error('Audio delete error: '.$e->getMessage());

            Notification::make()
                ->title('Error deleting file')
                ->body('An error occurred while deleting the file.')
                ->danger()
                ->send();
        }
    }
}
