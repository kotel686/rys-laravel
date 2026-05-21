<?php

declare(strict_types=1);

namespace App\Filament\Resources\ClimbingTeamMemberResource\Pages;

use App\Filament\Resources\ClimbingTeamMemberResource;
use Filament\Resources\Pages\CreateRecord;

/**
 * Create page for {@see ClimbingTeamMemberResource}.
 */
class CreateClimbingTeamMember extends CreateRecord
{
    protected static string $resource = ClimbingTeamMemberResource::class;
}
