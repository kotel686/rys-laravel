<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ClimbingPriceResource\Pages;
use App\Models\ClimbingPrice;
use BackedEnum;
use UnitEnum;
use Filament\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Filament resource for managing climbing-wall pricing rows (Ceník).
 */
class ClimbingPriceResource extends Resource
{
    protected static ?string $model = ClimbingPrice::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Lezecká stěna – Ceník';

    protected static ?string $modelLabel = 'Položka ceníku';

    protected static ?string $pluralModelLabel = 'Ceník';

    protected static string|UnitEnum|null $navigationGroup = 'Lezecká stěna';

    protected static ?int $navigationSort = 50;

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                TextInput::make('category')
                    ->label('Kategorie')
                    ->helperText('Např. Vstupné, Permanentky, Kroužky')
                    ->datalist([
                        'Vstupné',
                        'Permanentky',
                        'Kroužky',
                        'Půjčovna',
                        'Ostatní',
                    ])
                    ->required()
                    ->maxLength(120),

                TextInput::make('sort_order')
                    ->label('Pořadí')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]),

            TextInput::make('name')
                ->label('Název položky')
                ->required()
                ->maxLength(255),

            Grid::make(2)->schema([
                TextInput::make('price')
                    ->label('Cena')
                    ->helperText('Např. "150 Kč" nebo "od 1 500 Kč"')
                    ->required()
                    ->maxLength(60),

                TextInput::make('unit')
                    ->label('Jednotka')
                    ->helperText('Volitelné, např. "/ vstup", "/ měsíc"')
                    ->maxLength(60),
            ]),

            Textarea::make('description')
                ->label('Popis')
                ->rows(3)
                ->maxLength(1000)
                ->columnSpanFull(),

            Toggle::make('is_published')
                ->label('Zobrazovat na webu')
                ->default(true),
        ]);
    }

    /**
     * Build the listing table.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategorie')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Název')
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Cena'),

                Tables\Columns\TextColumn::make('unit')
                    ->label('Jednotka')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publ.')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Pořadí')
                    ->sortable(),
            ])
            ->defaultSort('category')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')->label('Publikováno'),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategorie')
                    ->options(fn (): array => ClimbingPrice::query()
                        ->select('category')
                        ->distinct()
                        ->pluck('category', 'category')
                        ->all()),
            ])
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
            'index' => Pages\ListClimbingPrices::route('/'),
            'create' => Pages\CreateClimbingPrice::route('/create'),
            'edit' => Pages\EditClimbingPrice::route('/{record}/edit'),
        ];
    }
}
