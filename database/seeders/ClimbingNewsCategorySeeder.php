<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Novius\LaravelFilamentNews\Models\NewsCategory;

/**
 * Ensure the "Lezecká stěna" news category exists.
 *
 * The category slug `lezecka-stena` is used by ClimbingNewsController
 * to filter posts shown on the climbing-wall mini-site.
 */
class ClimbingNewsCategorySeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        NewsCategory::query()->firstOrCreate(
            ['slug' => 'lezecka-stena'],
            [
                'name' => 'Lezecká stěna',
                'locale' => config('app.locale', 'cs'),
            ],
        );
    }
}
