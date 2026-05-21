<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Pricing row shown in the Ceník section of the Lezecká stěna mini-site.
 *
 * Rows are grouped by `category` (e.g. "Vstupné", "Permanentky", "Kroužky")
 * and ordered by `sort_order` within each group.
 *
 * @property int $id
 * @property string $category
 * @property string $name
 * @property string $price
 * @property string|null $unit
 * @property string|null $description
 * @property int $sort_order
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
#[Fillable([
    'category',
    'name',
    'price',
    'unit',
    'description',
    'sort_order',
    'is_published',
])]
class ClimbingPrice extends Model
{
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
     * Group a collection of pricing rows by category, preserving order.
     *
     * @param  Collection<int, self>  $rows
     * @return array<string, list<self>>
     */
    public static function groupByCategory(Collection $rows): array
    {
        /** @var array<string, list<self>> $grouped */
        $grouped = [];

        foreach ($rows as $row) {
            $grouped[$row->category][] = $row;
        }

        return $grouped;
    }
}
