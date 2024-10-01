<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->nullable(),
                Forms\Components\Select::make('created_by')
                    ->relationship('creator', 'name')
                    ->required(),
                ]),
                Forms\Components\Grid::make()
                ->columns(1)
                ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Select::make('completed_by')
                ->relationship('completer', 'name')
                ->nullable(),
            Forms\Components\Toggle::make('is_completed')
                    ->default(false),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('project.name')
                ->label('At Project')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('creator.name')
            ->label('Created By')->searchable()->sortable(),
            Tables\Columns\BooleanColumn::make('is_completed')->label('Completed'),
        ])
       
            ->filters([
                Tables\Filters\SelectFilter::make('is_completed')->options([
                    1 => 'Completed',
                    0 => 'Incomplete',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTasks::route('/'),
        ];
    }
}
