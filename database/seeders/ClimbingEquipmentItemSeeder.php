<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingEquipmentItem;
use Illuminate\Database\Seeder;

/**
 * Seed the default "Vybavení" bullet list on /o-stene. Values are
 * Lorem ipsum placeholders – replace from the Filament admin.
 *
 * Idempotent: keyed on `name`.
 */
class ClimbingEquipmentItemSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        /** @var list<array{name:string,sort_order:int}> $rows */
        $rows = [
            ['name' => 'Lorem ipsum dolor sit amet',      'sort_order' => 10],
            ['name' => 'Consectetur adipiscing elit',     'sort_order' => 20],
            ['name' => 'Sed do eiusmod tempor',           'sort_order' => 30],
            ['name' => 'Ut labore et dolore magna',       'sort_order' => 40],
        ];

        foreach ($rows as $row) {
            ClimbingEquipmentItem::query()->updateOrCreate(
                ['name' => $row['name']],
                [
                    'sort_order' => $row['sort_order'],
                    'is_published' => true,
                ],
            );
        }
    }
}
