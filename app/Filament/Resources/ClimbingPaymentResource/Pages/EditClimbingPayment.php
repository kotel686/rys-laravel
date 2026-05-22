<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingPaymentResource\Pages;

use App\Filament\Resources\ClimbingPaymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Edit page for {@see ClimbingPaymentResource}.
 */
class EditClimbingPayment extends EditRecord
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
            Actions\DeleteAction::make(),
        ];
    }
}
