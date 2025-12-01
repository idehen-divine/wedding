<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Main database seeder for wedding application
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with wedding data
     */
    public function run(): void
    {
        $this->call([
            WeddingWishSeeder::class,
            StoryTimelineSeeder::class,
            WeddingSettingSeeder::class,
        ]);
    }
}
