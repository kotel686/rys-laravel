<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingPriceResource\Pages;

use App\Filament\Resources\ClimbingPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Edit page for {@see ClimbingPriceResource}.
 */
class EditClimbingPrice extends EditRecord
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
            Actions\DeleteAction::make(),
        ];
    }
}
