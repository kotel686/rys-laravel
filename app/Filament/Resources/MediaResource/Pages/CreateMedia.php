<?php

declare(strict_types=1);

namespace App\Filament\Resources\MediaResource\Pages;

use App\Filament\Resources\MediaResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see MediaResource}.
 */
class CreateMedia extends CreateRecord
{
    protected static string $resource = MediaResource::class;
}
