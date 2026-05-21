<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingPostResource\Pages;

use App\Filament\Resources\ClimbingPostResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see ClimbingPostResource}.
 */
class CreateClimbingPost extends CreateRecord
{
    protected static string $resource = ClimbingPostResource::class;
}
