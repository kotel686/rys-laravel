<?php

declare(strict_types=1);

namespace App\Filament\Clusters;

use BackedEnum;
use Filament\Clusters\Cluster;
use UnitEnum;

/**
 * Sidebar parent for /lezeckastena/aktuality.
 */
class News extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Aktuality';

    protected static ?string $clusterBreadcrumb = 'Aktuality';

    protected static string|UnitEnum|null $navigationGroup = 'Lezecká stěna';

    protected static ?int $navigationSort = 40;
}
