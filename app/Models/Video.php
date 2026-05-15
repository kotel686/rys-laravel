<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Video shown in the public media gallery.
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $video_path
 * @property string|null $poster_path
 * @property string|null $duration
 * @property int $sort_order
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
#[Fillable([
    'title',
    'description',
    'video_path',
    'poster_path',
    'duration',
    'sort_order',
    'is_published',
])]
class Video extends Model
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
     * Public URL of the video file.
     */
    public function videoUrl(): string
    {
        return Storage::disk('public')->url($this->video_path);
    }

    /**
     * Public URL of the optional poster image.
     */
    public function posterUrl(): ?string
    {
        return $this->poster_path
            ? Storage::disk('public')->url($this->poster_path)
            : null;
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
            ->orderByDesc('id');
    }
}
