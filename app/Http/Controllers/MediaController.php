<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Public media streaming.
 *
 * Videos uploaded through the admin live on the `public` filesystem disk
 * and are normally served via the `/storage` symlink. PHP's built-in
 * development server (used by `php artisan serve`) cannot answer HTTP
 * `Range` requests for those static files, which prevents browsers from
 * seeking inside a video. Routing video bytes through this controller
 * delegates to Symfony's {@see BinaryFileResponse}, which honours `Range`
 * headers (and replies with `206 Partial Content`) regardless of the
 * underlying server.
 */
class MediaController extends Controller
{
    /**
     * Stream the binary contents of a video {@see Media} record.
     */
    public function stream(Media $media): BinaryFileResponse
    {
        abort_unless($media->isVideo() && $media->is_published, 404);

        $absolutePath = Storage::disk('public')->path($media->file_path);

        abort_unless(is_file($absolutePath), 404);

        return response()->file($absolutePath, [
            'Content-Type' => $media->mimeType(),
            'Accept-Ranges' => 'bytes',
            'Cache-Control' => 'public, max-age=3600',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
