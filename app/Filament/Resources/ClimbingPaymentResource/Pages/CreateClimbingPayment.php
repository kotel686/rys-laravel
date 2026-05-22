<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingPaymentResource\Pages;

use App\Filament\Resources\ClimbingPaymentResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see ClimbingPaymentResource}.
 */
class CreateClimbingPayment extends CreateRecord
{
    protected static string $resource = ClimbingPaymentResource::class;
}
