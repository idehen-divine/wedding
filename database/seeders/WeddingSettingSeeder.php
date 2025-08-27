<?php

namespace Database\Seeders;

use App\Enums\SettingGroup;
use App\Enums\SettingType;
use App\Models\WeddingSetting;
use Illuminate\Database\Seeder;

/**
 * Seeder for wedding configuration settings
 */
class WeddingSettingSeeder extends Seeder
{
    /**
     * Seed wedding settings with default configuration values
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'bride_name',
                'value' => 'Precious',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::GENERAL->value,
                'label' => 'Bride Name',
                'description' => 'Name of the bride',
                'sort_order' => 1,
            ],
            [
                'key' => 'groom_name',
                'value' => 'Franklin',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::GENERAL->value,
                'label' => 'Groom Name',
                'description' => 'Name of the groom',
                'sort_order' => 2,
            ],
            [
                'key' => 'wedding_date',
                'value' => '2025-08-30',
                'type' => SettingType::DATE->value,
                'group' => SettingGroup::GENERAL->value,
                'label' => 'Wedding Date',
                'description' => 'Date of the wedding ceremony',
                'sort_order' => 3,
            ],
            [
                'key' => 'wedding_hashtag',
                'value' => '#PreciousAndFranklinForever',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::GENERAL->value,
                'label' => 'Wedding Hashtag',
                'description' => 'Social media hashtag for the wedding',
                'sort_order' => 4,
            ],
            [
                'key' => 'footer_tagline',
                'value' => 'Celebrating love, family, and the beginning of our forever journey together.',
                'type' => SettingType::TEXTAREA->value,
                'group' => SettingGroup::GENERAL->value,
                'label' => 'Footer Tagline',
                'description' => 'Tagline displayed in the footer',
                'sort_order' => 5,
            ],

            // Ceremony Details
            [
                'key' => 'ceremony_name',
                'value' => 'St. Mary\'s Cathedral',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::CEREMONY->value,
                'label' => 'Ceremony Venue Name',
                'description' => 'Name of the ceremony venue',
                'sort_order' => 10,
            ],
            [
                'key' => 'ceremony_address',
                'value' => '123 Wedding Lane, Love City',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::CEREMONY->value,
                'label' => 'Ceremony Address',
                'description' => 'Address of the ceremony venue',
                'sort_order' => 11,
            ],
            [
                'key' => 'ceremony_time',
                'value' => '16:00',
                'type' => SettingType::TIME->value,
                'group' => SettingGroup::CEREMONY->value,
                'label' => 'Ceremony Time',
                'description' => 'Time of the ceremony',
                'sort_order' => 12,
            ],

            // Reception Details
            [
                'key' => 'reception_name',
                'value' => 'Grand Ballroom',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::RECEPTION->value,
                'label' => 'Reception Venue Name',
                'description' => 'Name of the reception venue',
                'sort_order' => 20,
            ],
            [
                'key' => 'reception_address',
                'value' => '456 Celebration Ave, Love City',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::RECEPTION->value,
                'label' => 'Reception Address',
                'description' => 'Address of the reception venue',
                'sort_order' => 21,
            ],
            [
                'key' => 'reception_start_time',
                'value' => '18:00',
                'type' => SettingType::TIME->value,
                'group' => SettingGroup::RECEPTION->value,
                'label' => 'Reception Start Time',
                'description' => 'Start time of the reception',
                'sort_order' => 22,
            ],
            [
                'key' => 'reception_end_time',
                'value' => '23:00',
                'type' => SettingType::TIME->value,
                'group' => SettingGroup::RECEPTION->value,
                'label' => 'Reception End Time',
                'description' => 'End time of the reception',
                'sort_order' => 23,
            ],

            // Dress Code
            [
                'key' => 'dress_code_title',
                'value' => 'Formal Attire',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::GENERAL->value,
                'label' => 'Dress Code Title',
                'description' => 'Main dress code requirement',
                'sort_order' => 30,
            ],
            [
                'key' => 'dress_code_description',
                'value' => 'Cocktail dresses & suits',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::GENERAL->value,
                'label' => 'Dress Code Description',
                'description' => 'Detailed dress code description',
                'sort_order' => 31,
            ],
            [
                'key' => 'dress_code_colors',
                'value' => 'Blush & Gold Welcome',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::GENERAL->value,
                'label' => 'Preferred Colors',
                'description' => 'Wedding color theme',
                'sort_order' => 32,
            ],

            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'wedding@preciousfranklin.com',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::CONTACT->value,
                'label' => 'Contact Email',
                'description' => 'Main contact email',
                'sort_order' => 40,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+15551234567',
                'type' => SettingType::TEXT->value,
                'group' => SettingGroup::CONTACT->value,
                'label' => 'Contact Phone',
                'description' => 'Main contact phone number',
                'sort_order' => 41,
            ],

            // Social Media Links
            [
                'key' => 'instagram_url',
                'value' => '',
                'type' => SettingType::URL->value,
                'group' => SettingGroup::SOCIAL->value,
                'label' => 'Instagram URL',
                'description' => 'Instagram profile or hashtag URL',
                'sort_order' => 50,
            ],
            [
                'key' => 'facebook_url',
                'value' => '',
                'type' => SettingType::URL->value,
                'group' => SettingGroup::SOCIAL->value,
                'label' => 'Facebook URL',
                'description' => 'Facebook page URL',
                'sort_order' => 51,
            ],
            [
                'key' => 'twitter_url',
                'value' => '',
                'type' => SettingType::URL->value,
                'group' => SettingGroup::SOCIAL->value,
                'label' => 'Twitter URL',
                'description' => 'Twitter profile URL',
                'sort_order' => 52,
            ],

            // Music Settings
            [
                'key' => 'background_music',
                'value' => 'storage/audio/Harmony (Default).mp3',
                'type' => SettingType::AUDIO->value,
                'group' => SettingGroup::MUSIC->value,
                'label' => 'Background Music',
                'description' => 'Background music for the website',
                'sort_order' => 60,
            ],

            // Gallery Settings
            [
                'key' => 'gallery_published',
                'value' => '0',
                'type' => SettingType::BOOLEAN->value,
                'group' => SettingGroup::GALLERY->value,
                'label' => 'Gallery Published',
                'description' => 'Whether the photo gallery is published and visible to guests',
                'sort_order' => 70,
            ],
        ];

        foreach ($settings as $settingData) {
            WeddingSetting::updateOrCreate(
                ['key' => $settingData['key']],
                $settingData
            );
        }
    }
}
