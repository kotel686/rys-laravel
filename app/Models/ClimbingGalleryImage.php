<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * An image displayed in the PhotoSwipe gallery on the climbing-wall
 * home page (/lezeckastena). Width/height are captured at upload time
 * so the frontend lightbox can present them without an extra HEAD
 * request.
 *
 * @property int $id
 * @property string $image_path
 * @property string|null $alt
 * @property int|null $width
 * @property int|null $height
 * @property int $sort_order
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
#[Fillable([
    'image_path',
    'alt',
    'width',
    'height',
    'sort_order',
    'is_published',
])]
class ClimbingGalleryImage extends Model
{
    /**
     * Attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'width' => 'integer',
            'height' => 'integer',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    /**
     * Boot the model and populate width/height from the uploaded file
     * whenever the path changes. Falls back silently if the file is not
     * yet on disk (e.g. queued upload).
     */
    protected static function booted(): void
    {
        static::saving(function (self $image): void {
            if (! $image->isDirty('image_path') || $image->image_path === null) {
                return;
            }

            $absolute = Storage::disk('public')->path($image->image_path);
            if (! is_file($absolute)) {
                return;
            }

            $size = @getimagesize($absolute);
            if ($size !== false) {
                $image->width = $size[0];
                $image->height = $size[1];
            }
        });
    }

    /**
     * Public URL of the image, served via the /storage symlink.
     */
    public function imageUrl(): string
    {
        return Storage::disk('public')->url($this->image_path);
    }

    /**
     * Scope: only published rows, in display order.
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
