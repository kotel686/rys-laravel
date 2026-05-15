<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * A piece of media (photo or video) shown in the public media gallery.
 *
 * @property int $id
 * @property string $type      'image' or 'video'
 * @property string $title
 * @property string|null $description
 * @property string $file_path
 * @property string|null $poster_path
 * @property string|null $duration
 * @property int $sort_order
 * @property bool $is_published
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
#[Fillable([
    'type',
    'title',
    'description',
    'file_path',
    'poster_path',
    'duration',
    'sort_order',
    'is_published',
])]
class Media extends Model
{
    public const TYPE_IMAGE = 'image';

    public const TYPE_VIDEO = 'video';

    /**
     * Force the conventional table name (Eloquent would otherwise look for
     * `medias`).
     */
    protected $table = 'media';

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
     * Is this row a video?
     */
    public function isVideo(): bool
    {
        return $this->type === self::TYPE_VIDEO;
    }

    /**
     * Public URL for the main asset. Images go straight to the storage
     * symlink, videos are routed through the streaming controller so the
     * built-in `php artisan serve` (which cannot honour Range requests
     * against static files) does not break playback.
     */
    public function fileUrl(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    /**
     * URL that the frontend should use as the playable video source. For
     * images it is identical to {@see self::fileUrl()}.
     */
    public function streamUrl(): string
    {
        return $this->isVideo()
            ? route('media.stream', ['media' => $this->getKey()])
            : $this->fileUrl();
    }

    /**
     * Public URL of the optional video poster image.
     */
    public function posterUrl(): ?string
    {
        return $this->poster_path
            ? Storage::disk('public')->url($this->poster_path)
            : null;
    }

    /**
     * Best-effort MIME type derived from the file extension. Used by
     * lightGallery's video plugin so it can pick a compatible decoder.
     */
    public function mimeType(): string
    {
        $ext = strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));

        return match ($ext) {
            'webm' => 'video/webm',
            'mov' => 'video/quicktime',
            'mkv' => 'video/x-matroska',
            'avi' => 'video/x-msvideo',
            'ogv', 'ogg' => 'video/ogg',
            default => 'video/mp4',
        };
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
