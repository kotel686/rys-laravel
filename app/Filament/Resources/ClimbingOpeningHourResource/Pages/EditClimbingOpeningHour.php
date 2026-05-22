<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingOpeningHourResource\Pages;

use App\Filament\Resources\ClimbingOpeningHourResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Edit page for {@see ClimbingOpeningHourResource}.
 */
class EditClimbingOpeningHour extends EditRecord
{
    protected static string $resource = ClimbingOpeningHourResource::class;

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
