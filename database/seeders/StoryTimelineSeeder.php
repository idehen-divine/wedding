<?php

namespace Database\Seeders;

use App\Models\StoryTimeline;
use Illuminate\Database\Seeder;

class StoryTimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storyEvents = [
            [
                'title' => 'First Meeting',
                'date' => 'September 2019',
                'description' => 'We met at a coffee shop in downtown. Precious was reading her favorite book, and Franklin couldn\'t help but ask about it. The conversation lasted for hours.',
                'image_path' => 'story-images/story-1.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'First Date',
                'date' => 'October 2019',
                'description' => 'Our first official date was at a charming Italian restaurant. Franklin was nervous, but Precious\'s laughter made everything perfect. We knew there was something special.',
                'image_path' => 'story-images/story-2.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Moving In Together',
                'date' => 'June 2021',
                'description' => 'After two years of dating, we decided to take the next step. Moving in together was an adventure filled with furniture shopping and learning each other\'s habits.',
                'image_path' => 'story-images/story-3.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'The Proposal',
                'date' => 'December 2023',
                'description' => 'Franklin proposed during a sunset walk on the beach where we had our first vacation together. Precious said yes before he could even finish asking the question!',
                'image_path' => 'story-images/story-4.jpg',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($storyEvents as $event) {
            StoryTimeline::create($event);
        }
    }
}
