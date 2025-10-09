<?php

namespace App\Filament\Agent\Resources;

use App\Filament\Agent\Resources\ClientResource\Pages;
use App\Filament\Agent\Resources\ClientResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Agents & Clients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('roles')
                    ->default('client')
                    ->label('Role')
                    ->options([
                        'client' => 'Client',
                        'agent' => 'Agent',
                    ])
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('company_name')
                    ->label('Company')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label('Email')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('address')
                    ->label('Address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address_2')
                    ->label('Address 2')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('city')
                    ->label('City')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('state')
                    ->label('State')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip')
                    ->label('Zip')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('country')
                    ->label('Country')
                    ->options([
                        'US' => 'United States',
                        'CA' => 'Canada',
                    ])
                    ->default('US'),
                Forms\Components\TextInput::make('description')
                    ->label('Description')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->revealable()
                    ->hiddenOn('edit')
                    ->maxLength(255),
                Forms\Components\Toggle::make('active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('agency_id', auth()->user()->agency_id)
                    ->whereIn('roles', ['client', 'agent']);
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Company')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('City')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('state')
                    ->label('State')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('country')
                    ->label('Country')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('website')
                    ->label('Website')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('roles')
                    ->label('Role')
                    ->searchable(),
            ])
            ->filters([
                // Filter by agents and by clients
                Filter::make('agents')
                    ->query(function (Builder $query) {
                        $query->where('roles', 'agent');
                    }),
                Filter::make('clients')
                    ->query(function (Builder $query) {
                        $query->where('roles', 'client');
                    }),
                ], FiltersLayout::AboveContent)
            ->defaultGroup('roles')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
