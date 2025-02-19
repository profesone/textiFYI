<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextResponseResource\Pages;
use App\Filament\Resources\TextResponseResource\RelationManagers;
use App\Models\Team;
use App\Models\TextResponse;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TextResponseResource extends Resource
{
    protected static ?string $model = TextResponse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('campaign'),
                Forms\Components\Textarea::make('notes'),
                Forms\Components\Textarea::make('response')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('notification_main')
                    ->tel(),
                Forms\Components\TextInput::make('notification_01')
                    ->tel(),
                Forms\Components\TagsInput::make('keywords')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('start_date'),
                Forms\Components\DatePicker::make('end_date'),
                Forms\Components\Toggle::make('active'),
                Forms\Components\Select::make('client.name')
                    ->label('Client')
                    ->options(User::pluck('name', 'id'))
                    ->required(),
                Forms\Components\Select::make('main_keyword_id'),
                Forms\Components\Select::make('team.name')
                    ->label('Team')
                    ->options(Team::pluck('name', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('campaign')
                    ->searchable(),
                Tables\Columns\TextColumn::make('notification_main')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('notification_01')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('client.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('main_keyword_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('keywords')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('team.name')
                    ->sortable(),
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
            'index' => Pages\ListTextResponses::route('/'),
            'create' => Pages\CreateTextResponse::route('/create'),
            'edit' => Pages\EditTextResponse::route('/{record}/edit'),
        ];
    }
}
