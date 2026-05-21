<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingProgram;
use Illuminate\Database\Seeder;

/**
 * Seed the default program cards shown on the Kroužky a oddíl page.
 *
 * Idempotent: keyed on `title` via `updateOrCreate`.
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
                'title' => 'Dětské tréninky',
                'subtitle' => 'Pravidelné lezecké kroužky',
                'description' => 'Pravidelné lezecké kroužky pro děti všech věkových kategorií. Zábavné učení základů lezení v bezpečném prostředí pod dohledem zkušených trenérů.',
                'bullets' => [
                    ['text' => 'Děti od 6 do 15 let'],
                    ['text' => 'Skupiny rozdělené podle věku a úrovně'],
                    ['text' => 'Důraz na bezpečnost a správnou techniku'],
                    ['text' => '1× nebo 2× týdně'],
                ],
                'sort_order' => 10,
            ],
            [
                'title' => 'Tréninky hendikepovaných',
                'subtitle' => 'Lezení pro každého',
                'description' => 'Pravidelné lezecké tréninky uzpůsobené potřebám lezců s hendikepem. Individuální přístup, vyškolení trenéři a speciální vybavení.',
                'bullets' => [
                    ['text' => 'Individuální plán a tempo'],
                    ['text' => 'Trenéři s praxí v paralezení'],
                    ['text' => 'Bezbariérový přístup ke stěně'],
                    ['text' => 'Možnost asistence'],
                ],
                'sort_order' => 20,
            ],
            [
                'title' => 'Lezecký oddíl',
                'subtitle' => 'Závodní příprava',
                'description' => 'Závodní příprava pro talentované lezce. Systematický tréninkový program, účast na soutěžích a podpora cesty k reprezentaci.',
                'bullets' => [
                    ['text' => 'Výběrové tréninky pro pokročilé'],
                    ['text' => 'Soutěžní příprava (obtížnost, bouldering)'],
                    ['text' => 'Systematická roční periodizace'],
                    ['text' => 'Doprovod na závody'],
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
