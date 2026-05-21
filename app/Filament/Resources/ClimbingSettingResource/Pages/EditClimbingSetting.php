<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingSettingResource\Pages;

use App\Filament\Resources\ClimbingSettingResource;
use Filament\Resources\Pages\EditRecord;

/**
 * Edit page for {@see ClimbingSettingResource}.
 */
class EditClimbingSetting extends EditRecord
{
    protected static string $resource = ClimbingSettingResource::class;
}
