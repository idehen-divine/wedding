<?php

namespace App\Models;

use App\Enums\SettingGroup;
use App\Enums\SettingType;
use Illuminate\Database\Eloquent\Model;

/**
 * Wedding settings model for storing configurable values
 *
 * @property int $id
 * @property string $key Setting key identifier
 * @property string $value Setting value
 * @property \App\Enums\SettingType $type Value type (string, boolean, date, time)
 * @property \App\Enums\SettingGroup $group Setting category group
 * @property string|null $label Human-readable label
 * @property string|null $description Setting description
 * @property int|null $sort_order Display order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class WeddingSetting extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key', 'value', 'type', 'group', 'label', 'description', 'sort_order',
    ];

    /**
     * Get the attributes that should be cast
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => SettingType::class,
            'group' => SettingGroup::class,
        ];
    }

    /**
     * Get a setting value by key with optional default
     *
     * @param  string  $key  Setting key to retrieve
     * @param  mixed  $default  Default value if setting not found
     * @return mixed The setting value cast to appropriate type
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        if (! $setting) {
            return $default;
        }

        return match ($setting->type) {
            SettingType::BOOLEAN => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            SettingType::DATE => $setting->value,
            SettingType::TIME => $setting->value ? \Carbon\Carbon::createFromFormat('H:i', $setting->value)->format('g:i A') : $setting->value,
            default => $setting->value,
        };
    }

    /**
     * Set a setting value by key
     *
     * @param  string  $key  Setting key to update
     * @param  mixed  $value  Value to store
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => (string) $value]
        );
    }
}
