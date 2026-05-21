<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ClimbingEquipmentItemResource\Pages;
use App\Models\ClimbingEquipmentItem;
use BackedEnum;
use UnitEnum;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Filament resource for the "Vybavení" bullet list on O stěně.
 */
class ClimbingEquipmentItemResource extends Resource
{
    protected static ?string $model = ClimbingEquipmentItem::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationLabel = 'Vybavení';

    protected static ?string $modelLabel = 'Položka vybavení';

    protected static ?string $pluralModelLabel = 'Vybavení';

    protected static string|UnitEnum|null $navigationGroup = 'Stěna – O stěně';

    protected static ?int $navigationSort = 40;

    protected static ?string $recordTitleAttribute = 'name';

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Název položky')
                ->helperText('Krátký bod, např. „Automatická jištění (automat)".')
                ->required()
                ->maxLength(160),

            Grid::make(2)->schema([
                TextInput::make('sort_order')
                    ->label('Pořadí')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Toggle::make('is_published')
                    ->label('Zobrazovat na webu')
                    ->default(true),
            ]),
        ]);
    }

    /**
     * Build the listing table.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Položka')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publ.')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Resource pages.
     *
     * @return array<string, mixed>
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClimbingEquipmentItems::route('/'),
            'create' => Pages\CreateClimbingEquipmentItem::route('/create'),
            'edit' => Pages\EditClimbingEquipmentItem::route('/{record}/edit'),
        ];
    }
}
