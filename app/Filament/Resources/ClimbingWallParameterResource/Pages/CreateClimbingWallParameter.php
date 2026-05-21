<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingWallParameterResource\Pages;

use App\Filament\Resources\ClimbingWallParameterResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see ClimbingWallParameterResource}.
 */
class CreateClimbingWallParameter extends CreateRecord
{
    protected static string $resource = ClimbingWallParameterResource::class;
}
