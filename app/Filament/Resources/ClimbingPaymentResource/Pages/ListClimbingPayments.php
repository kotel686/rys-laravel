<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingPaymentResource\Pages;

use App\Filament\Resources\ClimbingPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for {@see ClimbingPaymentResource}.
 */
class ListClimbingPayments extends ListRecords
{
    protected static string $resource = ClimbingPaymentResource::class;

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
