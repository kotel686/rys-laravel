<?php

declare(strict_types=1);

namespace App\Filament\Resources\PhotoResource\Pages;

use App\Filament\Resources\PhotoResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see PhotoResource}.
 */
class CreatePhoto extends CreateRecord
{
    protected static string $resource = PhotoResource::class;
}
