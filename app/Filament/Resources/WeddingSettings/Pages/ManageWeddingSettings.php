<?php

namespace App\Filament\Resources\WeddingSettings\Pages;

use App\Filament\Resources\WeddingSettings\WeddingSettingResource;
use App\Models\WeddingSetting;
use Filament\Forms\Components\DatePicker;
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
}
