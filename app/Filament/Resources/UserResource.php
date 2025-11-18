<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Agency;
use App\Models\User;
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
                    Forms\Components\Select::make('agency_id')
                        ->relationship(name: 'agency', titleAttribute: 'name')
                        ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('description')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('website')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\Select::make('owner_id')
                        ->label('Owner')
                        ->options(User::where('roles', 'lead_agent')
                            ->pluck('name', 'id'))
                        ->required(),
                ])
                ->columnSpanFull(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('company_name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->required(),
                Forms\Components\TextInput::make('address_2'),
                Forms\Components\TextInput::make('city')
                    ->required(),
                Forms\Components\TextInput::make('state')
                    ->required(),
                Forms\Components\TextInput::make('zip')
                    ->required(),
                Forms\Components\Select::make('country')
                    ->options([
                        'US' => 'United States',
                        'CA' => 'Canada'
                    ]),
                Forms\Components\TextInput::make('description'),
                Forms\Components\TextInput::make('website'),
                Forms\Components\Select::make('roles')
                    ->options([
                        'admin' => 'Admin',
                        'agent' => 'Agent',
                        'client' => 'Client',
                        'lead_agent' => 'Owner',
                    ])
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->required(),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->description(fn (User $record): string => substr($record->company_name, 0, 40) . "..."),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->description(fn (User $record): string => $record->city.', '.$record->state.', '.$record->country),
                Tables\Columns\TextColumn::make('agency.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('roles')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
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
            ])
            ->filters([
                //// Filter by agents and by clients
                Filter::make('agents')
                    ->query(function (Builder $query) {
                        $query->where('roles', 'agent');
                    }),
                Filter::make('clients')
                    ->query(function (Builder $query) {
                        $query->where('roles', 'client');
                    }),
                Filter::make('Admins')
                    ->query(function (Builder $query) {
                        $query->where('roles', 'admin');
                    }),
                Filter::make('Billable Client')
                    ->query(function (Builder $query) {
                        $query->where('roles', 'lead_agent');
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
