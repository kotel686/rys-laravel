<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingWallParameter;
use Illuminate\Database\Seeder;

/**
 * Seed the default "Parametry stěny" rows on /o-stene. Values are
 * Lorem ipsum placeholders – replace from the Filament admin.
 *
 * Idempotent: keyed on `label`.
 */
class ClimbingWallParameterSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        /** @var list<array{label:string,value:string,sort_order:int}> $rows */
        $rows = [
            ['label' => 'Lorem ipsum 1', 'value' => 'Dolor sit amet',       'sort_order' => 10],
            ['label' => 'Lorem ipsum 2', 'value' => 'Consectetur elit',     'sort_order' => 20],
            ['label' => 'Lorem ipsum 3', 'value' => 'Sed do eiusmod',       'sort_order' => 30],
            ['label' => 'Lorem ipsum 4', 'value' => 'Tempor incididunt',    'sort_order' => 40],
        ];

        foreach ($rows as $row) {
            ClimbingWallParameter::query()->updateOrCreate(
                ['label' => $row['label']],
                [
                    'value' => $row['value'],
                    'sort_order' => $row['sort_order'],
                    'is_published' => true,
                ],
            );
        }
    }
}
