<?php

namespace App\Filament\Resources;

use App\State;
use App\Filament\Resources\DispatchResource\Pages;
use App\Filament\Resources\DispatchResource\RelationManagers;
use App\Models\Dispatch;
use App\Models\User;
use App\Models\TextifyiNumber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DispatchResource extends Resource
{
    protected static ?string $model = Dispatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Select or Create Company')
                    ->schema([
                        Forms\Components\Select::make('company_id')
                            ->relationship(name: 'company', titleAttribute: 'name')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->placeholder('Example: Lone Star: North Division')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('address')
                                    ->maxLength(255)
                                    ->default(null),
                                Forms\Components\TextInput::make('address_2')
                                    ->maxLength(50)
                                    ->default(null),
                                Forms\Components\TextInput::make('city')
                                    ->default(null),
                                Forms\Components\Select::make('state')
                                    ->options(State::getStates())
                                    ->default(null),
                                Forms\Components\TextInput::make('zip')
                                    ->maxLength(5)
                                    ->numeric()
                                    ->default(null),
                                Forms\Components\TextInput::make('country')
                                    ->maxLength(100)
                                    ->default(null),
                                Forms\Components\TextInput::make('description')
                                    ->maxLength(255)
                                    ->default(null),
                                Forms\Components\TextInput::make('website')
                                    ->url()
                                    ->placeholder('Example: https://www.lonestartx.com')
                                    ->default(null),
                                Forms\Components\Select::make('client.company_name')
                                    ->relationship(name: 'client', titleAttribute: 'company_name')
                                    ->required()
                            ])
                            ->columnSpanFull(),
                    ]),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->placeholder('Example: Seasonal Campaigns'),
                Forms\Components\Textarea::make('default_message'),
                Forms\Components\Textarea::make('default_request_message'),
                Forms\Components\Textarea::make('default_zipcode_message'),
                Forms\Components\Textarea::make('email_address_response'),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('agent')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->defaultGroup('company.name')
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
            'index' => Pages\ListDispatches::route('/'),
            'create' => Pages\CreateDispatch::route('/create'),
            'edit' => Pages\EditDispatch::route('/{record}/edit'),
        ];
    }
}
