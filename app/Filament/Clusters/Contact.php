<?php

declare(strict_types=1);

namespace App\Filament\Clusters;

use BackedEnum;
use Filament\Clusters\Cluster;
use UnitEnum;

/**
 * Sidebar parent for /lezeckastena/kontakt (opening hours, …).
 */
class Contact extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-phone';

    protected static ?string $navigationLabel = 'Kontakt';

    protected static ?string $clusterBreadcrumb = 'Kontakt';

    protected static string|UnitEnum|null $navigationGroup = 'Lezecká stěna';

    protected static ?int $navigationSort = 50;
}
