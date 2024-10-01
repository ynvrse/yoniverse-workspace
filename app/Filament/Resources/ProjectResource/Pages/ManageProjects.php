<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProjects extends ManageRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
