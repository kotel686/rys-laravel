<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingWallParameterResource\Pages;

use App\Filament\Resources\ClimbingWallParameterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Edit page for {@see ClimbingWallParameterResource}.
 */
class EditClimbingWallParameter extends EditRecord
{
    protected static string $resource = ClimbingWallParameterResource::class;

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
