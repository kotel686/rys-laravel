<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingProgramResource\Pages;

use App\Filament\Resources\ClimbingProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for {@see ClimbingProgramResource}.
 */
class ListClimbingPrograms extends ListRecords
{
    protected static string $resource = ClimbingProgramResource::class;

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
