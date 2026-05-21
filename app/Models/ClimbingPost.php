<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * News / aktuality post shown on the Lezecká stěna mini-site.
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $image_path
 * @property string|null $excerpt
 * @property string|null $content
 * @property Carbon|null $published_at
 * @property bool $is_published
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
#[Fillable([
    'title',
    'slug',
    'image_path',
    'excerpt',
    'content',
    'published_at',
    'is_published',
])]
class ClimbingPost extends Model
{
    /**
     * Attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    /**
     * Public URL for the post's lead image, or `null` if not set.
     */
    public function imageUrl(): ?string
    {
        return $this->image_path === null
            ? null
            : Storage::disk('public')->url($this->image_path);
    }

    /**
     * Resolve the value used in route-model binding (slug).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Scope: only published posts whose `published_at` is null or in the past,
     * ordered newest first for public display.
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_published', true)
            ->where(function (Builder $q): void {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }
}
