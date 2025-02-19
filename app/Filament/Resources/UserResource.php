<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
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
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(),
                Forms\Components\TextInput::make('role_id')
                    ->required()
                    ->numeric()
                    ->default(3),
                Forms\Components\TextInput::make('company_name'),
                Forms\Components\Textarea::make('main_contact_number')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('default_message')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('default_request_message')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('default_zipcode_message')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('email_address_response')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('default_messages_module'),
                Forms\Components\Toggle::make('default_message_notification'),
                Forms\Components\Toggle::make('default_message_response'),
                Forms\Components\Toggle::make('publish_keywords_module'),
                Forms\Components\Toggle::make('leads_module'),
                Forms\Components\Toggle::make('keyword_module'),
                Forms\Components\Toggle::make('mls_listing_module'),
                Forms\Components\Toggle::make('mls_agent_notification'),
                Forms\Components\Toggle::make('tips_request_module'),
                Forms\Components\Toggle::make('zip_code_module'),
                Forms\Components\Toggle::make('default_zip_notification'),
                Forms\Components\Toggle::make('email_address_module'),
                Forms\Components\Toggle::make('default_email_notification'),
                Forms\Components\Select::make('team_id')
                    ->relationship(name: 'team', titleAttribute: 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('user.name')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role_id')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '3' => 'warning',
                        '2' => 'success',
                        '1' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('default_messages_module'),
                Tables\Columns\ToggleColumn::make('default_message_notification'),
                Tables\Columns\ToggleColumn::make('default_message_response'),
                Tables\Columns\ToggleColumn::make('publish_keywords_module'),
                Tables\Columns\ToggleColumn::make('leads_module'),
                Tables\Columns\ToggleColumn::make('keyword_module'),
                Tables\Columns\ToggleColumn::make('mls_listing_module'),
                Tables\Columns\ToggleColumn::make('mls_agent_notification'),
                Tables\Columns\ToggleColumn::make('tips_request_module'),
                Tables\Columns\ToggleColumn::make('zip_code_module'),
                Tables\Columns\ToggleColumn::make('default_zip_notification'),
                Tables\Columns\ToggleColumn::make('email_address_module'),
                Tables\Columns\ToggleColumn::make('default_email_notification'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('team.name')
                    ->label('Team'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
