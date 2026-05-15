<?php

declare(strict_types=1);

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

/**
 * Detail (view-only) page for {@see ContactMessageResource}.
 */
class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    /**
     * Header actions.
     *
     * @return array<int, Actions\Action|Actions\ActionGroup>
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('markHandled')
                ->label('Označit jako vyřízeno')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn (): bool => ! $this->record->isHandled())
                ->action(function (): void {
                    /** @var ContactMessage $record */
                    $record = $this->record;
                    $record->update(['handled_at' => now()]);
                }),

            Actions\Action::make('markUnhandled')
                ->label('Vrátit do nevyřízených')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('warning')
                ->visible(fn (): bool => $this->record->isHandled())
                ->action(function (): void {
                    /** @var ContactMessage $record */
                    $record = $this->record;
                    $record->update(['handled_at' => null]);
                }),

            Actions\DeleteAction::make(),
        ];
    }
}
