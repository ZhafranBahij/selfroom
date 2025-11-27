<?php

namespace App\Filament\Resources\Inventories;

use App\Filament\Resources\Inventories\Pages\ManageInventories;
use App\Models\Inventory;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Inventory';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('item_id')
                    ->relationship('item', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('description')
                            ->maxLength(255),
                    ])
                    ->required(),
                Select::make('location_id')
                    ->relationship('location', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('description')
                            ->maxLength(255),
                    ])
                    ->required(),
                TextInput::make('detail_location'),
                Select::make('condition')
                    ->options([
                        'bagus' => 'Bagus',
                        'rusak_minor' => 'Rusak Minor',
                        'rusak_major' => 'Rusak Major',
                    ])
                    ->default('bagus')
                    ->required(),
                TextInput::make('note')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('item.name')
                    ->label('Item'),
                TextEntry::make('location.name')
                    ->label('Location'),
                TextEntry::make('detail_location')
                    ->placeholder('-'),
                TextEntry::make('condition')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'bagus' => 'Bagus',
                        'rusak_minor' => 'Rusak Minor',
                        'rusak_major' => 'Rusak Major',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'bagus' => 'success',
                        'rusak_minor' => 'warning',
                        'rusak_major' => 'danger',
                    }),
                TextEntry::make('note')
                    ->columnSpanFull()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                // TextEntry::make('deleted_at')
                //     ->dateTime()
                //     ->visible(fn(Inventory $record): bool => $record->trashed()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(static::getModel()::query()->latest())
            ->columns([
                TextColumn::make('item.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('detail_location')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('condition')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'bagus' => 'Bagus',
                        'rusak_minor' => 'Rusak Minor',
                        'rusak_major' => 'Rusak Major',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'bagus' => 'success',
                        'rusak_minor' => 'warning',
                        'rusak_major' => 'danger',
                    })
                    ->sortable(),
                TextColumn::make('note')
                    ->limit(30)
                    ->tooltip(fn (string $state): string => $state),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function getPages(): array
    {
        return [
            'index' => ManageInventories::route('/'),
        ];
    }
}
