<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Team member shown on the O stěně page.
 *
 * @property int $id
 * @property string $name
 * @property string|null $role
 * @property string|null $bio
 * @property string|null $image_path
 * @property int $sort_order
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
#[Fillable([
    'name',
    'role',
    'bio',
    'image_path',
    'sort_order',
    'is_published',
])]
class ClimbingTeamMember extends Model
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
     * Public URL for the portrait photo, or `null` if not set.
     */
    public function imageUrl(): ?string
    {
        return $this->image_path === null
            ? null
            : Storage::disk('public')->url($this->image_path);
    }

    /**
     * Initials derived from the member's name, used as an avatar fallback
     * when no portrait has been uploaded.
     */
    public function initials(): string
    {
        return collect(explode(' ', trim($this->name)))
            ->filter()
            ->map(fn (string $part): string => mb_substr($part, 0, 1))
            ->implode('');
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
