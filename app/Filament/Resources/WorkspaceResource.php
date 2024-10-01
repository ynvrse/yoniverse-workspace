<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkspaceResource\Pages;
use App\Models\Workspace;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WorkspaceResource extends Resource
{
    protected static ?string $model = Workspace::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                       
                    ]),
                    Forms\Components\Grid::make()
                    ->columns(2)
                    ->schema([
                 
                        Forms\Components\Select::make('is_public')
                            ->options([
                                1 => 'Public',
                                0 => 'Private',
                            ])->default(1)
                            ->required(),
                        Forms\Components\Select::make('created_by')
                            ->relationship('user', 'name')
                            ->required()->label('Created By'),
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->directory('logos'),
                        Forms\Components\FileUpload::make('cover')
                            ->label('Cover')
                            ->image()
                            ->directory('covers'),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Created By')->searchable()->sortable(),
                Tables\Columns\BooleanColumn::make('is_public')->label('Public'),
                Tables\Columns\ImageColumn::make('logo')->label('Logo'),
                Tables\Columns\ImageColumn::make('cover')->label('Cover'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_public')->options([
                    1 => 'Public',
                    0 => 'Private',
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
            'index' => Pages\ManageWorkspaces::route('/'),
        ];
    }
}
