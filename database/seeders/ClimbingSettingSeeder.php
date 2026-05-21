<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingSetting;
use Illuminate\Database\Seeder;

/**
 * Seed the default free-text snippets used on the Lezecká stěna pages.
 *
 * The `value` is Lorem ipsum placeholder; the admin replaces it from
 * Filament. Idempotent: existing rows keep their `value` (so the admin
 * doesn't lose edits on re-seed) – only the `label` description is
 * refreshed.
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
                'label' => 'O stěně – Úvodní text (Náš příběh)',
                'value' => <<<'HTML'
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
aliquip ex ea commodo consequat.</p>
<p>Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
cupidatat non proident, sunt in culpa qui officia deserunt mollit
anim id est laborum.</p>
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
