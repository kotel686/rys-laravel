<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingGalleryImageResource\Pages;

use App\Filament\Resources\ClimbingGalleryImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for {@see ClimbingGalleryImageResource}.
 */
class ListClimbingGalleryImages extends ListRecords
{
    protected static string $resource = ClimbingGalleryImageResource::class;

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
