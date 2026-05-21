<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingPriceResource\Pages;

use App\Filament\Resources\ClimbingPriceResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see ClimbingPriceResource}.
 */
class CreateClimbingPrice extends CreateRecord
{
    protected static string $resource = ClimbingPriceResource::class;
}
