<?php

namespace Database\Seeders;

use App\Models\WeddingWish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeddingWishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wishes = [
            [
                'name' => 'Sarah Johnson',
                'wish' => 'Wishing you both a lifetime of love, happiness, and endless adventures together. May your marriage be filled with beautiful moments and cherished memories. Congratulations on your beautiful union! 💕',
                'approved' => true,
            ],
            [
                'name' => 'Michael Brown',
                'wish' => 'So excited to celebrate with you both! May your marriage be filled with all the right ingredients: love, laughter, and lots of joy. Here\'s to a wonderful journey ahead together! 🥂',
                'approved' => true,
            ],
            [
                'name' => 'Emily Davis',
                'wish' => 'Your love story is truly inspiring! May you continue to find reasons to fall in love with each other every single day. Wishing you endless happiness and a lifetime of wonderful surprises! ✨',
                'approved' => true,
            ],
            [
                'name' => 'David Wilson',
                'wish' => 'Congratulations to the perfect couple! Your love radiates wherever you go. May your marriage be everything you\'ve dreamed of and more. Can\'t wait to celebrate your special day! 🎉',
                'approved' => true,
            ],
            [
                'name' => 'Lisa Martinez',
                'wish' => 'Wishing you a wonderful journey as you build your new lives together. May your love continue to grow stronger each day, and may you always find joy in the little moments you share. 💐',
                'approved' => true,
            ],
            [
                'name' => 'James Thompson',
                'wish' => 'From the moment I met you both, I knew you were meant to be together. Your love is beautiful and genuine. May your wedding day be just the beginning of a lifetime of happiness! 💒',
                'approved' => true,
            ],
            [
                'name' => 'Amanda Rodriguez',
                'wish' => 'Two hearts, one love, endless possibilities! May your marriage be a source of joy, strength, and comfort for years to come. Congratulations on finding your perfect match! 💗',
                'approved' => true,
            ],
            [
                'name' => 'Robert Kim',
                'wish' => 'May your love story continue to unfold in the most beautiful ways. Wishing you a marriage filled with laughter, understanding, and unconditional love. Cheers to your happily ever after! 🌟',
                'approved' => true,
            ],
            [
                'name' => 'Michelle Lee',
                'wish' => 'What a joy it is to witness true love! May your wedding day be everything you\'ve imagined and your marriage everything you\'ve hoped for. Here\'s to love, laughter, and happily ever after! 🎊',
                'approved' => false, // This one is pending approval to show the admin workflow
            ]
        ];

        foreach ($wishes as $wishData) {
            WeddingWish::create($wishData);
        }
    }
}
