<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingEquipmentItemResource\Pages;

use App\Filament\Resources\ClimbingEquipmentItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Edit page for {@see ClimbingEquipmentItemResource}.
 */
class EditClimbingEquipmentItem extends EditRecord
{
    protected static string $resource = ClimbingEquipmentItemResource::class;

    /**
     * Header actions.
     *
     * @return array<int, Actions\Action|Actions\ActionGroup>
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
