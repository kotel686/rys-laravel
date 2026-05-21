<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingWallParameterResource\Pages;

use App\Filament\Resources\ClimbingWallParameterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for {@see ClimbingWallParameterResource}.
 */
class ListClimbingWallParameters extends ListRecords
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
            Actions\CreateAction::make(),
        ];
    }
}
