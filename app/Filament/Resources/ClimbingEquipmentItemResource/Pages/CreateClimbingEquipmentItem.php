<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingEquipmentItemResource\Pages;

use App\Filament\Resources\ClimbingEquipmentItemResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see ClimbingEquipmentItemResource}.
 */
class CreateClimbingEquipmentItem extends CreateRecord
{
    protected static string $resource = ClimbingEquipmentItemResource::class;
}
