<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ClimbingPrice;
use Illuminate\Database\Seeder;

/**
 * Seed example pricing rows for the Lezecká stěna section.
 *
 * Idempotent: uses `updateOrCreate` keyed on (category, name) so re-running
 * the seeder will not duplicate rows.
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
            ['category' => 'Vstupné', 'name' => 'Dospělý',                    'price' => '150 Kč', 'unit' => '/ vstup', 'description' => 'Vstup na celý den.',          'sort_order' => 10],
            ['category' => 'Vstupné', 'name' => 'Student / senior',           'price' => '120 Kč', 'unit' => '/ vstup', 'description' => 'Po předložení průkazu.',      'sort_order' => 20],
            ['category' => 'Vstupné', 'name' => 'Dítě do 15 let',             'price' => '90 Kč',  'unit' => '/ vstup', 'description' => 'Doprovod dospělé osoby povinný.', 'sort_order' => 30],
            ['category' => 'Vstupné', 'name' => 'Rodinné vstupné',            'price' => '380 Kč', 'unit' => '/ vstup', 'description' => '2 dospělí + max. 2 děti.',    'sort_order' => 40],

            ['category' => 'Permanentky', 'name' => 'Permanentka 10 vstupů',  'price' => '1 200 Kč', 'unit' => null,    'description' => 'Platnost 12 měsíců, přenosná.','sort_order' => 10],
            ['category' => 'Permanentky', 'name' => 'Měsíční permanentka',    'price' => '1 600 Kč', 'unit' => '/ měsíc','description' => 'Neomezený počet vstupů.',     'sort_order' => 20],
            ['category' => 'Permanentky', 'name' => 'Roční permanentka',      'price' => '12 000 Kč','unit' => '/ rok', 'description' => 'Neomezený počet vstupů.',     'sort_order' => 30],

            ['category' => 'Kroužky', 'name' => 'Dětský kroužek 1× týdně',    'price' => '2 500 Kč', 'unit' => '/ pololetí', 'description' => '60 minut, max. 8 dětí na trenéra.', 'sort_order' => 10],
            ['category' => 'Kroužky', 'name' => 'Dětský kroužek 2× týdně',    'price' => '4 200 Kč', 'unit' => '/ pololetí', 'description' => '60 minut, max. 8 dětí na trenéra.', 'sort_order' => 20],
            ['category' => 'Kroužky', 'name' => 'Lezecký oddíl',              'price' => 'od 4 500 Kč','unit' => '/ pololetí', 'description' => 'Výběrové tréninky, závodní příprava.', 'sort_order' => 30],
            ['category' => 'Kroužky', 'name' => 'Tréninky hendikepovaných',   'price' => 'individuálně', 'unit' => null, 'description' => 'Cena dle programu, kontaktujte nás.', 'sort_order' => 40],

            ['category' => 'Půjčovna', 'name' => 'Lezečky',                   'price' => '60 Kč',  'unit' => '/ den', 'description' => null, 'sort_order' => 10],
            ['category' => 'Půjčovna', 'name' => 'Sedák',                     'price' => '40 Kč',  'unit' => '/ den', 'description' => null, 'sort_order' => 20],
            ['category' => 'Půjčovna', 'name' => 'Kompletní set',             'price' => '120 Kč', 'unit' => '/ den', 'description' => 'Lezečky + sedák + jistítko.', 'sort_order' => 30],
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
