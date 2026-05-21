<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingSettingResource\Pages;

use App\Filament\Resources\ClimbingSettingResource;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for {@see ClimbingSettingResource}.
 *
 * Settings are pre-seeded, so creation is intentionally not offered.
 */
class ListClimbingSettings extends ListRecords
{
    protected static string $resource = ClimbingSettingResource::class;
}
