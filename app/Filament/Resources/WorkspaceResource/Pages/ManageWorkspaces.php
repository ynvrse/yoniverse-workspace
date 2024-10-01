<?php

namespace App\Filament\Resources\WorkspaceResource\Pages;

use App\Filament\Resources\WorkspaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWorkspaces extends ManageRecords
{
    protected static string $resource = WorkspaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
