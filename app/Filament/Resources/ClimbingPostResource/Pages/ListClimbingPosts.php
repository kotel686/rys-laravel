<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingPostResource\Pages;

use App\Filament\Resources\ClimbingPostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

/**
 * List page for {@see ClimbingPostResource}.
 */
class ListClimbingPosts extends ListRecords
{
    protected static string $resource = ClimbingPostResource::class;

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
