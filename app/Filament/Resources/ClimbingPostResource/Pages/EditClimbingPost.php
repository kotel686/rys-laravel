<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingPostResource\Pages;

use App\Filament\Resources\ClimbingPostResource;
use App\Models\ClimbingPost;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Edit page for {@see ClimbingPostResource}.
 */
class EditClimbingPost extends EditRecord
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
            Actions\Action::make('view')
                ->label('Přejít na článek')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(fn (ClimbingPost $record): string => route('climbing.news.show', $record))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }
}
