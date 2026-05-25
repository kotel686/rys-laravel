<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingGalleryImageResource\Pages;

use App\Filament\Resources\ClimbingGalleryImageResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see ClimbingGalleryImageResource}.
 */
class CreateClimbingGalleryImage extends CreateRecord
{
    protected static string $resource = ClimbingGalleryImageResource::class;
}
