<?php

namespace App\Filament\Agent\Resources;

use App\Filament\Agent\Resources\DispatchResource\Pages;
use App\Filament\Agent\Resources\DispatchResource\RelationManagers;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;
use App\Filament\Resources\DispatchResource\RelationManagers\TextResponsesRelationManager;
use App\Models\Agency;
use App\Models\Dispatch;
use App\Models\TextifyiNumber;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function PHPUnit\Framework\isArray;

class DispatchResource extends Resource
{
    protected static ?string $model = Dispatch::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-pointing-out';

    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Client')
                    ->options(User::where('roles', '=', 'client')
                        ->where('agency_id', auth()->user()->agency_id)
                        ->pluck('name', 'id'))
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set, ?int $state) {
                        if ($state) {
                            $set('agency_id', User::find($state)->agency_id);
                        }
                    }),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\Select::make('textifyi_numbers')
                    ->multiple()
                    ->options(function ($get) {
                        $query = TextifyiNumber::where('agency_id', auth()->user()->agency_id);
                        
                        // Include already selected numbers even if they're marked as used
                        $selectedNumbers = $get('textifyi_numbers');
                        if (!empty($selectedNumbers) && is_array($selectedNumbers)) {
                            $query->where(function ($q) use ($selectedNumbers) {
                                $q->where('used', 0)
                                  ->orWhereIn('id', $selectedNumbers);
                            });
                        } else {
                            $query->where('used', 0);
                        }
                        
                        return $query->pluck('number', 'id')->toArray();
                    })
                    ->getOptionLabelUsing(function ($value) {
                        $number = TextifyiNumber::find($value);
                        return $number ? $number->number : $value;
                    })
                    ->searchable(),
                Forms\Components\Textarea::make('description'),
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
                Forms\Components\Checkbox::make('active'),
                Forms\Components\Hidden::make('agency_id')
                    ->default(auth()->user()->agency_id),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('agency_id', auth()->user()->agency_id);
            })
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('textifyi_numbers')
                    ->badge()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return TextifyiNumber::where('id', $state)
                            ->pluck('number')
                            ->toArray()[0];
                    }),
                Tables\Columns\IconColumn::make('active')
                    ->icon(fn (string $state): string => match ($state) {
                            '0' => 'heroicon-o-clock',
                            '1' => 'heroicon-o-check-circle',
                        })
                    ->color(fn (string $state): string => $state === '1' ? 'success' : 'danger'),
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
            ])
            ->filters([
                SelectFilter::make('client')
                    ->relationship(
                        'client',
                        'name',
                        fn (Builder $query) => $query
                            ->where('agency_id', auth()->user()->agency_id)
                            ->where('roles', 'client')
                    )
                    ->label('Client')
                    ->searchable()
                    ->preload()
            ], layout: FiltersLayout::AboveContent)
            ->defaultGroup('client.name')
            ->actions([
                Tables\Actions\EditAction::make(),
                RelationManagerAction::make('text-responses-relation-manager')
                    ->label('Responses')
                    ->relationManager(TextResponsesRelationManager::make()),
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
            TextResponsesRelationManager::class
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
