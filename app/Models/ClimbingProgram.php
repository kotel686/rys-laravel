<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Program card shown on the Kroužky a oddíl page.
 *
 * @property int $id
 * @property string $title
 * @property string|null $subtitle
 * @property string $description
 * @property list<string>|null $bullets
 * @property int $sort_order
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
#[Fillable([
    'title',
    'subtitle',
    'description',
    'bullets',
    'sort_order',
    'is_published',
])]
class ClimbingProgram extends Model
{
    /**
     * Attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'bullets' => 'array',
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
}
