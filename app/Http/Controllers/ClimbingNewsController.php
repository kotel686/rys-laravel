<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ClimbingPost;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Render the "Aktuality" pages for the Lezecká stěna mini-site.
 *
 * News posts are stored as {@see ClimbingPost} rows and edited from the
 * Filament admin panel.
 */
class ClimbingNewsController extends Controller
{
    /**
     * Render the paginated list of news posts.
     */
    public function index(): View
    {
        /** @var LengthAwarePaginator<ClimbingPost> $posts */
        $posts = ClimbingPost::query()
            ->published()
            ->paginate(12)
            ->withQueryString();

        return view('climbing.news.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Render a single news post resolved via route-model binding.
     */
    public function show(ClimbingPost $post): View
    {
        abort_unless($post->is_published, 404);

        $related = ClimbingPost::query()
            ->published()
            ->whereKeyNot($post->getKey())
            ->limit(3)
            ->get();

        return view('climbing.news.show', [
            'post' => $post,
            'related' => $related,
        ]);
    }
}
