<?php

namespace App\Filament\Resources\UserWorkspaceResource\Pages;

use App\Filament\Resources\UserWorkspaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUserWorkspaces extends ManageRecords
{
    protected static string $resource = UserWorkspaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
