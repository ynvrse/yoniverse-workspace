<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Project;
use App\Models\UserProject;

class CreateProjects extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function afterCreate(): void // Hapus parameter
    {
        $project = Project::find($this->record->id); // Ambil project yang baru dibuat
        $userProject = UserProject::create([
            'user_id' => auth()->user()->id,
            'project_id' => $project->id,
            'role' => 'owner',
        ]);
    }
}
