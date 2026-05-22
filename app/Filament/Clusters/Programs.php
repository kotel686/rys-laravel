<?php

declare(strict_types=1);

namespace App\Filament\Clusters;

use BackedEnum;
use Filament\Clusters\Cluster;
use UnitEnum;

/**
 * Sidebar parent for /lezeckastena/krouzky (program cards).
 */
class Programs extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Kroužky';

    protected static ?string $clusterBreadcrumb = 'Kroužky';

    protected static string|UnitEnum|null $navigationGroup = 'Lezecká stěna';

    protected static ?int $navigationSort = 20;
}
