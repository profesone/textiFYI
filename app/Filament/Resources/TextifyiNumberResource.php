<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextifyiNumberResource\Pages;
use App\Filament\Resources\TextifyiNumberResource\RelationManagers;
use App\Models\TextifyiNumber;
use App\Models\User;
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
                Forms\Components\TextInput::make('textifyi_numbers')
                    ->label('TextiFYI Number')
                    ->tel()
                    ->suffixIcon('heroicon-m-phone')
                    ->required(),
                Forms\Components\Select::make('agency.name')
                    ->label('Agent Name')
                    ->options(User::whereNull('team_id')
                        ->where('role_id', 2)
                        ->pluck('name', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('textifyi_numbers')
                    ->label('TextiFYI Number'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('agency.name')
                    ->label('Agent')
                    ->sortable(),
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
