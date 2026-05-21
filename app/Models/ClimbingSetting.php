<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Single key-value record holding a free-text snippet that the admin can
 * edit from Filament. Used for content that is one-of-a-kind on a page
 * (e.g. the "Náš příběh" story on /lezeckastena/o-stene).
 *
 * @property int $id
 * @property string $key
 * @property string $label
 * @property string|null $value
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
#[Fillable([
    'key',
    'label',
    'value',
])]
class ClimbingSetting extends Model
{
    /**
     * Resolve the rendered (HTML) value for a key, falling back to
     * `$default` when the key has not been seeded yet.
     */
    public static function value(string $key, string $default = ''): string
    {
        $cached = Cache::remember(
            'climbing_setting:' . $key,
            now()->addMinutes(10),
            fn (): ?string => self::query()->where('key', $key)->value('value'),
        );

        return $cached ?? $default;
    }

    /**
     * Invalidate the cache after the row is saved or deleted.
     */
    protected static function booted(): void
    {
        $forget = function (self $model): void {
            Cache::forget('climbing_setting:' . $model->key);
        };

        static::saved($forget);
        static::deleted($forget);
    }
}
