<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingProgram;
use Illuminate\Database\Seeder;

/**
 * Seed the default program cards shown on the Kroužky a oddíl page and
 * on the home page's "Naše programy" section.
 *
 * All text is Lorem ipsum placeholder – the admin replaces it from
 * Filament. Idempotent: keyed on `title`.
 */
class ClimbingProgramSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        /** @var list<array{title:string,subtitle:string,description:string,bullets:list<array{text:string}>,sort_order:int}> $rows */
        $rows = [
            [
                'title' => 'Program 1',
                'subtitle' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
                'bullets' => [
                    ['text' => 'Lorem ipsum dolor sit amet'],
                    ['text' => 'Consectetur adipiscing elit'],
                    ['text' => 'Sed do eiusmod tempor incididunt'],
                    ['text' => 'Ut labore et dolore magna aliqua'],
                ],
                'sort_order' => 10,
            ],
            [
                'title' => 'Program 2',
                'subtitle' => 'Duis aute irure dolor',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa.',
                'bullets' => [
                    ['text' => 'Excepteur sint occaecat cupidatat'],
                    ['text' => 'Non proident sunt in culpa'],
                    ['text' => 'Qui officia deserunt mollit'],
                    ['text' => 'Anim id est laborum'],
                ],
                'sort_order' => 20,
            ],
            [
                'title' => 'Program 3',
                'subtitle' => 'Sed ut perspiciatis unde',
                'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis.',
                'bullets' => [
                    ['text' => 'Nemo enim ipsam voluptatem'],
                    ['text' => 'Quia voluptas sit aspernatur'],
                    ['text' => 'Aut odit aut fugit'],
                    ['text' => 'Sed quia consequuntur magni'],
                ],
                'sort_order' => 30,
            ],
        ];

        foreach ($rows as $row) {
            ClimbingProgram::query()->updateOrCreate(
                ['title' => $row['title']],
                [
                    'subtitle' => $row['subtitle'],
                    'description' => $row['description'],
                    'bullets' => $row['bullets'],
                    'sort_order' => $row['sort_order'],
                    'is_published' => true,
                ],
            );
        }
    }
}
