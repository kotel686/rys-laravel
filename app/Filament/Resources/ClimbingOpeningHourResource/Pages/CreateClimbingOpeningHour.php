<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingOpeningHourResource\Pages;

use App\Filament\Resources\ClimbingOpeningHourResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see ClimbingOpeningHourResource}.
 */
class CreateClimbingOpeningHour extends CreateRecord
{
    protected static string $resource = ClimbingOpeningHourResource::class;
}
