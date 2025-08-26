<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Story timeline model for wedding story events
 *
 * @property int $id
 * @property string $title Event title
 * @property string $date Event date
 * @property string $description Event description
 * @property string|null $image_path Path to event image
 * @property int $sort_order Display order
 * @property bool $is_active Whether event is active/visible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class StoryTimeline extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'date',
        'description',
        'image_path',
        'sort_order',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
