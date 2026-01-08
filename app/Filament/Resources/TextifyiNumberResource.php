<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextifyiNumberResource\Pages;
use App\Filament\Resources\TextifyiNumberResource\RelationManagers;
use App\Models\TextifyiNumber;
use App\Models\Agency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
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
                Forms\Components\Select::make('agency_id')
                    ->label('Agency')
                    ->options(Agency::pluck('name', 'id'))
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('notes')
                    ->prefixIcon('heroicon-o-pencil')
                    ->helperText('Notes are optional'),
                Forms\Components\TextInput::make('number')
                    ->tel()
                    ->telRegex('/^[1-9]\d{2}\.\d{3}\.\d{4}$/')
                    ->prefixIcon('heroicon-o-phone')
                    ->helperText('Format: 123.456.7890')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->label('TextiFYI #')
                    ->searchable(),
                Tables\Columns\TextColumn::make('agency.owner.name')
                    ->label('Billable Client')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('notes')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('used')
                    ->boolean(),
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
            ->actions([
		    Tables\Actions\DeleteAction::make(),
		    Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTextifyiNumbers::route('/'),
            'create' => Pages\CreateTextifyiNumber::route('/create'),
            'edit' => Pages\EditTextifyiNumber::route('/{record}/edit'),
        ];
    }
}
