<?php

namespace App\Filament\Resources\UserProjectResource\Pages;

use App\Filament\Resources\UserProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUserProjects extends ManageRecords
{
    protected static string $resource = UserProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
