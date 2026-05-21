<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingPrice;
use Illuminate\Database\Seeder;

/**
 * Seed example pricing rows for the Lezecká stěna section.
 *
 * Idempotent: uses `updateOrCreate` keyed on (category, name) so re-running
 * the seeder will not duplicate rows. All text content is Lorem ipsum
 * placeholder – replace from the Filament admin panel.
 */
class ClimbingPriceSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        /** @var list<array{category:string,name:string,price:string,unit:?string,description:?string,sort_order:int}> $rows */
        $rows = [
            ['category' => 'Lorem ipsum 1', 'name' => 'Lorem ipsum dolor',      'price' => '100 Kč', 'unit' => '/ vstup',   'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sort_order' => 10],
            ['category' => 'Lorem ipsum 1', 'name' => 'Sit amet consectetur',   'price' => '150 Kč', 'unit' => '/ vstup',   'description' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'sort_order' => 20],
            ['category' => 'Lorem ipsum 1', 'name' => 'Adipiscing elit',        'price' => '90 Kč',  'unit' => '/ vstup',   'description' => 'Ut enim ad minim veniam, quis nostrud exercitation.', 'sort_order' => 30],

            ['category' => 'Lorem ipsum 2', 'name' => 'Duis aute irure',        'price' => '1 200 Kč', 'unit' => null,      'description' => 'Ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'sort_order' => 10],
            ['category' => 'Lorem ipsum 2', 'name' => 'Reprehenderit voluptate','price' => '1 600 Kč', 'unit' => '/ měsíc', 'description' => 'Duis aute irure dolor in reprehenderit in voluptate.', 'sort_order' => 20],
            ['category' => 'Lorem ipsum 2', 'name' => 'Velit esse cillum',      'price' => '12 000 Kč','unit' => '/ rok',   'description' => 'Excepteur sint occaecat cupidatat non proident.', 'sort_order' => 30],

            ['category' => 'Lorem ipsum 3', 'name' => 'Officia deserunt',       'price' => '2 500 Kč', 'unit' => '/ pololetí', 'description' => 'Mollit anim id est laborum sed ut perspiciatis.', 'sort_order' => 10],
            ['category' => 'Lorem ipsum 3', 'name' => 'Unde omnis iste',        'price' => '4 200 Kč', 'unit' => '/ pololetí', 'description' => 'Natus error sit voluptatem accusantium doloremque.', 'sort_order' => 20],
            ['category' => 'Lorem ipsum 3', 'name' => 'Laudantium totam',       'price' => 'od 4 500 Kč','unit' => '/ pololetí', 'description' => 'Rem aperiam eaque ipsa quae ab illo inventore.', 'sort_order' => 30],

            ['category' => 'Lorem ipsum 4', 'name' => 'Quasi architecto',       'price' => '60 Kč',  'unit' => '/ den', 'description' => null, 'sort_order' => 10],
            ['category' => 'Lorem ipsum 4', 'name' => 'Beatae vitae',           'price' => '40 Kč',  'unit' => '/ den', 'description' => null, 'sort_order' => 20],
            ['category' => 'Lorem ipsum 4', 'name' => 'Dicta sunt explicabo',   'price' => '120 Kč', 'unit' => '/ den', 'description' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur.', 'sort_order' => 30],
        ];

        foreach ($rows as $row) {
            ClimbingPrice::query()->updateOrCreate(
                ['category' => $row['category'], 'name' => $row['name']],
                [
                    'price' => $row['price'],
                    'unit' => $row['unit'],
                    'description' => $row['description'],
                    'sort_order' => $row['sort_order'],
                    'is_published' => true,
                ],
            );
        }
    }
}
