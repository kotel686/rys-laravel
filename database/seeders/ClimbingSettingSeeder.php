<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingSetting;
use Illuminate\Database\Seeder;

/**
 * Seed the default free-text snippets used on the Lezecká stěna pages.
 *
 * Idempotent: existing rows are left untouched; only the `label` field
 * is refreshed so the admin sees an up-to-date description.
 */
class ClimbingSettingSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        /** @var list<array{key:string,label:string,value:string}> $rows */
        $rows = [
            [
                'key' => 'about.story',
                'label' => 'O stěně – Náš příběh (úvodní text)',
                'value' => <<<'HTML'
<p>Lezecká stěna vznikla z lásky k lezení a touhy nabídnout dětem
i dospělým prostor, kde si můžou vyzkoušet něco nového, posunout
své hranice a najít komunitu lidí se stejným nadšením.</p>
<p>Provozuje ji <a href="/">František Rys – Výškové práce</a>, takže
za vším stojí roky zkušeností s prací ve výškách, důraz na bezpečnost
a profesionalitu.</p>
HTML,
            ],
        ];

        foreach ($rows as $row) {
            $existing = ClimbingSetting::query()->where('key', $row['key'])->first();

            if ($existing === null) {
                ClimbingSetting::query()->create($row);
                continue;
            }

            $existing->fill(['label' => $row['label']])->save();
        }
    }
}
