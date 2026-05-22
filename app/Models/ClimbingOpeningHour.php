<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * One row of the climbing-wall opening hours table.
 *
 * @property int $id
 * @property string $day_label
 * @property string $hours
 * @property int $sort_order
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
#[Fillable([
    'day_label',
    'hours',
    'sort_order',
    'is_published',
])]
class ClimbingOpeningHour extends Model
{
    /**
     * Cache key for the published rows (used by the footer partial so
     * the query doesn't run twice on contact pages).
     */
    private const CACHE_KEY = 'climbing_opening_hours:published';

    /**
     * Attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    /**
     * Scope: only published rows, ordered for public display.
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /**
     * Memoised list of published rows for the footer / contact card.
     *
     * @return Collection<int, self>
     */
    public static function forDisplay(): Collection
    {
        /** @var Collection<int, self> $rows */
        $rows = Cache::remember(
            self::CACHE_KEY,
            now()->addMinutes(10),
            fn (): Collection => self::query()->published()->get(),
        );

        return $rows;
    }

    /**
     * Invalidate the cache after the row is saved or deleted.
     */
    protected static function booted(): void
    {
        $forget = static fn () => Cache::forget(self::CACHE_KEY);

        static::saved($forget);
        static::deleted($forget);
    }
}
