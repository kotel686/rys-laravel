<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for {@see ContactMessageResource}.
 */
class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;
}
