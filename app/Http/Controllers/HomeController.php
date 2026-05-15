<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Project;
use App\Models\Video;
use Illuminate\Contracts\View\View;

/**
 * Render the public landing page (home).
 */
class HomeController extends Controller
{
    /**
     * Render the home page with published projects, photos and videos.
     */
    public function __invoke(): View
    {
        return view('home', [
            'projects' => Project::query()->published()->get(),
            'photos' => Photo::query()->published()->get(),
            'videos' => Video::query()->published()->get(),
        ]);
    }
}
