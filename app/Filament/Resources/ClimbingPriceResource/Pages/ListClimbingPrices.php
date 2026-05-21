<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingPriceResource\Pages;

use App\Filament\Resources\ClimbingPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for {@see ClimbingPriceResource}.
 */
class ListClimbingPrices extends ListRecords
{
    protected static string $resource = ClimbingPriceResource::class;

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
