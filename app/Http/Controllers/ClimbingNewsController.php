<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Novius\LaravelFilamentNews\Models\NewsCategory;
use Novius\LaravelFilamentNews\Models\NewsPost;

/**
 * Render the "Aktuality" pages for the Lezecká stěna mini-site.
 *
 * Posts are stored and edited via the {@see \Novius\LaravelFilamentNews}
 * plugin in the Filament admin. They are scoped to the "Lezecká stěna"
 * category (slug `lezecka-stena`) so the same plugin can later host news
 * for other sections of the site without leaking into this one.
 */
class ClimbingNewsController extends Controller
{
    /**
     * Slug of the news category used to scope posts to this mini-site.
     */
    private const CATEGORY_SLUG = 'lezecka-stena';

    /**
     * Render the paginated list of climbing-wall news posts.
     */
    public function index(): View
    {
        $category = NewsCategory::query()
            ->where('slug', self::CATEGORY_SLUG)
            ->first();

        /** @var LengthAwarePaginator<NewsPost> $posts */
        $posts = NewsPost::query()
            ->published()
            ->when(
                $category !== null,
                fn ($query) => $query->whereHas(
                    'categories',
                    fn ($q) => $q->whereKey($category->id),
                ),
            )
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('climbing.news.index', [
            'posts' => $posts,
            'category' => $category,
        ]);
    }

    /**
     * Render a single news post by slug.
     */
    public function show(string $slug): View
    {
        /** @var NewsPost $post */
        $post = NewsPost::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $related = NewsPost::query()
            ->published()
            ->whereKeyNot($post->getKey())
            ->whereHas(
                'categories',
                fn ($q) => $q->where('slug', self::CATEGORY_SLUG),
            )
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('climbing.news.show', [
            'post' => $post,
            'related' => $related,
        ]);
    }
}
