<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages\ManageProjects;
use App\Filament\Resources\ProjectResource\Pages\CreateProjects;
use App\Models\Project;
use App\Models\UserProject;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Model;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                ->columns(3)
                ->schema([
                        Select::make('workspace_id')
                        ->relationship('workspace', 'name')
                        ->required(),

                        Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'in_progress' => 'In Progress',
                            'on_review' => 'On Review',
                            'completed' => 'Completed',
                        ])->default('draft'),
                        DatePicker::make('due_date')->required(),

                ]),
                Forms\Components\Grid::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Select::make('priority')
                        ->options([
                            'low' => 'Low',
                            'medium' => 'Medium',
                            'high' => 'High',
                        ])->default('medium'),
                    ]),
                Forms\Components\Grid::make()
                    ->columns(1)
                    ->schema([
                        
                        Textarea::make('description'),
                  
                    ]),
        
                
                ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('priority'),
                Tables\Columns\TextColumn::make('tasks_count')->counts('tasks')->label('Tasks'),
                Tables\Columns\TextColumn::make('members_count')->counts('members')->label('Members'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options([
                    'draft' => 'Draft',
                    'in_progress' => 'In Progress',
                    'on_review' => 'On Review',
                    'completed' => 'Completed',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }



    public static function getPages(): array
    {
        return [

            'index' => ManageProjects::route('/'),
            'create' => CreateProjects::route('/create'),
        ];
    }
}
