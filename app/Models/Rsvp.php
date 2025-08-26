<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * RSVP model for wedding guest responses
 *
 * @property int $id
 * @property string $name Guest's full name
 * @property string $email Guest's email address
 * @property string|null $whatsapp Guest's WhatsApp number
 * @property int $guests Number of guests attending
 * @property string $attendance Attendance status (yes/no)
 * @property string|null $message Optional message from guest
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Rsvp extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'guests',
        'attendance',
        'message',
    ];

    /**
     * Get the attributes that should be cast
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'guests' => 'integer',
        ];
    }
}
