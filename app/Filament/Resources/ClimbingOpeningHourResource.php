<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ClimbingOpeningHourResource\Pages;
use App\Models\ClimbingOpeningHour;
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
 * Filament resource for the opening-hours rows shown on the climbing
 * contact page and in the shared climbing footer.
 */
class ClimbingOpeningHourResource extends Resource
{
    protected static ?string $model = ClimbingOpeningHour::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Otevírací doba';

    protected static ?string $modelLabel = 'Otevírací doba';

    protected static ?string $pluralModelLabel = 'Otevírací doba';

    protected static string|UnitEnum|null $navigationGroup = 'Stěna – Kontakt';

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'day_label';

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                TextInput::make('day_label')
                    ->label('Dny')
                    ->helperText('Např. „Po – Pá" nebo „Sobota".')
                    ->required()
                    ->maxLength(60),

                TextInput::make('hours')
                    ->label('Hodiny')
                    ->helperText('Např. „14:00 – 21:00" nebo „Zavřeno".')
                    ->required()
                    ->maxLength(60),
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

                Tables\Columns\TextColumn::make('day_label')
                    ->label('Dny'),

                Tables\Columns\TextColumn::make('hours')
                    ->label('Hodiny'),

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
            'index' => Pages\ListClimbingOpeningHours::route('/'),
            'create' => Pages\CreateClimbingOpeningHour::route('/create'),
            'edit' => Pages\EditClimbingOpeningHour::route('/{record}/edit'),
        ];
    }
}
