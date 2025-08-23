<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryTimeline extends Model
{
    protected $fillable = [
        'title',
        'date',
        'description',
        'image_path',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
