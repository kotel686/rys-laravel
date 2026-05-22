<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingOpeningHour;
use Illuminate\Database\Seeder;

/**
 * Seed the default opening hours shown on the climbing contact page
 * and in the shared climbing footer.
 *
 * Idempotent: keyed on `day_label`.
 */
class ClimbingOpeningHourSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        /** @var list<array{day_label:string,hours:string,sort_order:int}> $rows */
        $rows = [
            ['day_label' => 'Po – Pá', 'hours' => '14:00 – 21:00', 'sort_order' => 10],
            ['day_label' => 'So – Ne', 'hours' => '10:00 – 20:00', 'sort_order' => 20],
        ];

        foreach ($rows as $row) {
            ClimbingOpeningHour::query()->updateOrCreate(
                ['day_label' => $row['day_label']],
                [
                    'hours' => $row['hours'],
                    'sort_order' => $row['sort_order'],
                    'is_published' => true,
                ],
            );
        }
    }
}
