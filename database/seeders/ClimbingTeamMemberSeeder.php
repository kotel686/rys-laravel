<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingTeamMember;
use Illuminate\Database\Seeder;

/**
 * Seed the default team members shown on the O stěně page.
 *
 * Idempotent: keyed on `name` via `updateOrCreate`.
 */
class ClimbingTeamMemberSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        /** @var list<array{name:string,role:string,bio:string,sort_order:int}> $rows */
        $rows = [
            [
                'name' => 'František Rys',
                'role' => 'Hlavní trenér',
                'bio' => 'Historicky první reprezentant ČR v paralezení, první medailista z mezinárodní soutěže (3. místo z ME ve Villars).',
                'sort_order' => 10,
            ],
        ];

        foreach ($rows as $row) {
            ClimbingTeamMember::query()->updateOrCreate(
                ['name' => $row['name']],
                [
                    'role' => $row['role'],
                    'bio' => $row['bio'],
                    'sort_order' => $row['sort_order'],
                    'is_published' => true,
                ],
            );
        }
    }
}
