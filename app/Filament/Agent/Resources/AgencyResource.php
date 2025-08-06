<?php

namespace App\Filament\Agent\Resources;

use App\Filament\Agent\Resources\AgencyResource\Pages;
use App\Filament\Agent\Resources\AgencyResource\RelationManagers;
use App\Models\Agency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgencyResource extends Resource
{
    protected static ?string $model = Agency::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Agency';

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->modifyQueryUsing(function (Builder $query) {
            $query->where('id', auth()->user()->agency_id);
        })
        ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner.name')
                    ->badge()
                    ->label('Owner')
                    ->sortable(),
                Tables\Columns\TextColumn::make('users.name')
                    ->badge()
                    ->label('Agents')
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
                Filter::make('id')
                    ->query(function (Builder $query, array $data): void {
                        $query->where('id', auth()->user()->agency_id)
                            ->where('roles', '!=', 'client');
                    }),
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
            'index' => Pages\ListAgencies::route('/'),
            'edit' => Pages\EditAgency::route('/{record}/edit'),
        ];
    }
}
