<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextifyiNumberResource\Pages;
use App\Filament\Resources\TextifyiNumberResource\RelationManagers;
use App\Models\TextifyiNumber;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TextifyiNumberResource extends Resource
{
    protected static ?string $model = TextifyiNumber::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->required(),
                Forms\Components\Select::make('team_id.name')
                    ->label('Team')
                    ->options(Team::all()->pluck('name', 'id'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->sortable(),
                Tables\Columns\TextColumn::make('team_id.name')
                    ->label('Team')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([])
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
            'index' => Pages\ListTextifyiNumbers::route('/'),
            'create' => Pages\CreateTextifyiNumber::route('/create'),
            'edit' => Pages\EditTextifyiNumber::route('/{record}/edit'),
        ];
    }
}
