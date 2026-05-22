<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Wipe all climbing-wall data tables in one shot.
 *
 * Useful when you want to clear the lorem-ipsum demo content the
 * seeders shipped and start typing in the real copy. Drops every row
 * from each `climbing_*` table; admin user / Výškové práce tables stay
 * untouched.
 *
 * Usage:
 *   php artisan climbing:wipe              (asks for confirmation)
 *   php artisan climbing:wipe --force      (skip confirmation – CI / scripted)
 */
class ClimbingWipe extends Command
{
    /**
     * @var string
     */
    protected $signature = 'climbing:wipe {--force : Skip the confirmation prompt}';

    /**
     * @var string
     */
    protected $description = 'Smaže všechna data ve všech climbing_* tabulkách (Aktuality, Ceník, Programy, Tým, …).';

    /**
     * Tables wiped by the command, in an order safe for FK constraints.
     *
     * @var list<string>
     */
    private const TABLES = [
        'climbing_posts',
        'climbing_prices',
        'climbing_payments',
        'climbing_programs',
        'climbing_team_members',
        'climbing_wall_parameters',
        'climbing_equipment_items',
        'climbing_opening_hours',
        'climbing_settings',
    ];

    /**
     * Cache keys to forget after the wipe so the public views don't
     * keep showing stale snapshots.
     *
     * @var list<string>
     */
    private const CACHE_KEYS = [
        'climbing_opening_hours:published',
        'climbing_setting:about.story',
    ];

    /**
     * Execute the command.
     */
    public function handle(): int
    {
        $this->components->info('Smazání všech dat z climbing_* tabulek.');

        if (! $this->option('force') && ! $this->confirm('Tato akce smaže VŠECHNA data o lezecké stěně (Aktuality, Ceník, Programy, Tým, …). Pokračovat?')) {
            $this->components->warn('Zrušeno – databáze beze změny.');

            return self::SUCCESS;
        }

        $deleted = 0;

        DB::transaction(function () use (&$deleted): void {
            foreach (self::TABLES as $table) {
                if (! Schema::hasTable($table)) {
                    $this->components->warn("Tabulka {$table} neexistuje – přeskakuji.");

                    continue;
                }

                $count = DB::table($table)->count();
                DB::table($table)->delete();
                $deleted += $count;

                $this->components->task("{$table} (smazáno {$count})", fn (): bool => true);
            }
        });

        foreach (self::CACHE_KEYS as $key) {
            Cache::forget($key);
        }

        $this->components->info("Hotovo – smazáno {$deleted} řádků celkem.");

        return self::SUCCESS;
    }
}
