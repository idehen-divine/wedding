<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Wedding wish model for guest well wishes
 *
 * @property int $id
 * @property string $name Guest's name who submitted the wish
 * @property string $wish The wedding wish message
 * @property bool $approved Whether the wish is approved for display
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class WeddingWish extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'wish',
        'approved',
    ];

    /**
     * Get the attributes that should be cast
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'approved' => 'boolean',
        ];
    }
}
