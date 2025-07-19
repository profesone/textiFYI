<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\Agency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('roles')
                    ->default('client')
                    ->label('Role')
                    ->required()
                    ->options([
                        'client' => 'Client',
                        'agent' => 'Agent',
                        'agent_lead' => 'Agent Lead',
                        'admin' => 'Admin',
                    ])
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('name')
                    ->required(),
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
                        'MX' => 'Mexico',
                    ])
                    ->default('US'),
                Forms\Components\TextInput::make('description')
                    ->label('Description')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('agency.name')
                    ->label('Agency')
                    ->options(Agency::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->maxLength(255),
                Forms\Components\Toggle::make('active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('company_name')
                ->label('Company')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
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
                ->searchable(),
            Tables\Columns\TextColumn::make('description')
                ->label('Description')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('website')
                ->label('Website')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\ToggleColumn::make('active'),
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
        ->defaultGroup('agency.name')
        ->filters([
            Filter::make('agent_lead')
                ->query(function (Builder $query) {
                    $query->where('roles', 'agent_lead');
                }),
            Filter::make('agents')
                ->query(function (Builder $query) {
                    $query->where('roles', 'agent');
                }),
            Filter::make('clients')
                ->query(function (Builder $query) {
                    $query->where('roles', 'client');
                }),
            ], FiltersLayout::AboveContent)
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
