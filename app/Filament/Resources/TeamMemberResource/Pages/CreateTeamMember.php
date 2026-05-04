<?php

namespace App\Filament\Resources\TeamMemberResource\Pages;

use App\Filament\Resources\TeamMemberResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTeamMember extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = TeamMemberResource::class;
}
