<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ClimbingPrice;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Render the public pages for the Lezecká stěna (climbing wall) mini-site.
 *
 * Pages live under the `/lezeckastena` URL prefix on the main
 * vyskovepracerys.cz domain. The dedicated subdomain
 * lezeckastena.vyskovepracerys.cz is redirected to the same prefix
 * by {@see self::redirectFromSubdomain()}.
 */
class ClimbingController extends Controller
{
    /**
     * Render the climbing-wall home page.
     */
    public function home(): View
    {
        return view('climbing.home');
    }

    /**
     * Render the "O stěně" (About the wall) page.
     */
    public function about(): View
    {
        return view('climbing.about');
    }

    /**
     * Render the pricing page, grouped by category.
     */
    public function pricing(): View
    {
        $prices = ClimbingPrice::query()->published()->get();

        return view('climbing.pricing', [
            'grouped' => ClimbingPrice::groupByCategory($prices),
        ]);
    }

    /**
     * Render the "Kroužky a oddíl" page.
     */
    public function programs(): View
    {
        return view('climbing.programs');
    }

    /**
     * Render the "Kontakt" page.
     */
    public function contact(): View
    {
        return view('climbing.contact');
    }

    /**
     * Permanently redirect requests on the lezeckastena.* subdomain
     * to the equivalent /lezeckastena URL on the main domain.
     */
    public function redirectFromSubdomain(Request $request): RedirectResponse
    {
        $path = trim($request->path(), '/');
        $target = config('app.url') . '/lezeckastena' . ($path === '' ? '' : '/' . $path);

        return redirect()->away($target, status: 301);
    }
}
