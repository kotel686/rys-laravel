<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ClimbingWallParameterResource\Pages;
use App\Models\ClimbingWallParameter;
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
 * Filament resource for the "Parametry stěny" label/value rows on O stěně.
 */
class ClimbingWallParameterResource extends Resource
{
    protected static ?string $model = ClimbingWallParameter::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationLabel = 'O stěně – Parametry stěny';

    protected static ?string $modelLabel = 'Parametr stěny';

    protected static ?string $pluralModelLabel = 'Parametry stěny';

    protected static string|UnitEnum|null $navigationGroup = 'Lezecká stěna';

    protected static ?int $navigationSort = 46;

    protected static ?string $recordTitleAttribute = 'label';

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                TextInput::make('label')
                    ->label('Štítek')
                    ->helperText('Levá strana řádku, např. „Obtížnost".')
                    ->required()
                    ->maxLength(120),

                TextInput::make('value')
                    ->label('Hodnota')
                    ->helperText('Pravá strana řádku, např. „4 – 9 UIAA".')
                    ->required()
                    ->maxLength(120),
            ]),

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

                Tables\Columns\TextColumn::make('label')
                    ->label('Štítek')
                    ->searchable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Hodnota'),

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
            'index' => Pages\ListClimbingWallParameters::route('/'),
            'create' => Pages\CreateClimbingWallParameter::route('/create'),
            'edit' => Pages\EditClimbingWallParameter::route('/{record}/edit'),
        ];
    }
}
