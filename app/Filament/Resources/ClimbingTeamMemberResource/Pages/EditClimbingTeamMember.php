<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingTeamMemberResource\Pages;

use App\Filament\Resources\ClimbingTeamMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

/**
 * Edit page for {@see ClimbingTeamMemberResource}.
 */
class EditClimbingTeamMember extends EditRecord
{
    protected static string $resource = ClimbingTeamMemberResource::class;

    /**
     * Header actions.
     *
     * @return array<int, Actions\Action|Actions\ActionGroup>
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
