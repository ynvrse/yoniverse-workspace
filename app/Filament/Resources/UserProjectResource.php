<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserProjectResource\Pages;
use App\Filament\Resources\UserProjectResource\RelationManagers;
use App\Models\UserProject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserProjectResource extends Resource
{
    protected static ?string $model = UserProject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('role')
                    ->options([
                        'owner' => 'Owner',
                        'member' => 'Member',
                    ])
                    ->default('member')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('role')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'owner' => 'Owner',
                        'member' => 'Member',
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUserProjects::route('/'),
        ];
    }
}
