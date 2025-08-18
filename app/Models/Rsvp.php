<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'guests',
        'attendance',
        'message',
    ];

    protected function casts(): array
    {
        return [
            'guests' => 'integer',
        ];
    }
}
