<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Project;
use Illuminate\Contracts\View\View;

/**
 * Render the public landing page (home).
 */
class HomeController extends Controller
{
    /**
     * Render the home page with published projects and media.
     */
    public function __invoke(): View
    {
        return view('home', [
            'projects' => Project::query()->published()->get(),
            'mediaItems' => Media::query()->published()->get(),
        ]);
    }
}
