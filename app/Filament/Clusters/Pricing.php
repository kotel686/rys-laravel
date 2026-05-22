<?php

declare(strict_types=1);

namespace App\Filament\Clusters;

use BackedEnum;
use Filament\Clusters\Cluster;
use UnitEnum;

/**
 * Sidebar parent for /lezeckastena/cenik (price rows + QR payments).
 */
class Pricing extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Ceník';

    protected static ?string $clusterBreadcrumb = 'Ceník';

    protected static string|UnitEnum|null $navigationGroup = 'Lezecká stěna';

    protected static ?int $navigationSort = 30;
}
