<?php

declare(strict_types=1);

namespace App\Filament\Clusters;

use BackedEnum;
use Filament\Clusters\Cluster;
use UnitEnum;

/**
 * Sidebar parent for everything that drives /lezeckastena/o-stene –
 * úvodní text, tým, parametry stěny, vybavení.
 */
class AboutWall extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'O stěně';

    protected static ?string $clusterBreadcrumb = 'O stěně';

    protected static string|UnitEnum|null $navigationGroup = 'Lezecká stěna';

    protected static ?int $navigationSort = 10;
}
