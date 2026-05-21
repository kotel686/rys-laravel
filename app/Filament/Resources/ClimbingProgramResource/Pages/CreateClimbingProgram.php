<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingProgramResource\Pages;

use App\Filament\Resources\ClimbingProgramResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see ClimbingProgramResource}.
 */
class CreateClimbingProgram extends CreateRecord
{
    protected static string $resource = ClimbingProgramResource::class;
}
