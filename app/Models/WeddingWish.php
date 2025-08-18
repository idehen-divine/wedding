<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingWish extends Model
{
    protected $fillable = [
        'name',
        'wish',
        'approved',
    ];

    protected function casts(): array
    {
        return [
            'approved' => 'boolean',
        ];
    }
}
