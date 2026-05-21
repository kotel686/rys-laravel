<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingTeamMember;
use Illuminate\Database\Seeder;

/**
 * Seed the default team members shown on the O stěně page.
 *
 * All text is Lorem ipsum placeholder. Idempotent: keyed on `name`.
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
                'name' => 'Lorem Ipsum',
                'role' => 'Dolor sit amet',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'sort_order' => 10,
            ],
            [
                'name' => 'Consectetur Adipiscing',
                'role' => 'Tempor incididunt',
                'bio' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'sort_order' => 20,
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
