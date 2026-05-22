<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingOpeningHourResource\Pages;

use App\Filament\Resources\ClimbingOpeningHourResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for {@see ClimbingOpeningHourResource}.
 */
class ListClimbingOpeningHours extends ListRecords
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
            Actions\CreateAction::make(),
        ];
    }
}
