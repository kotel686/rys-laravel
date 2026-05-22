<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Clusters\Programs;
use App\Filament\Resources\ClimbingProgramResource\Pages;
use App\Models\ClimbingProgram;
use BackedEnum;
use Filament\Actions;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Filament resource for managing program cards on the Kroužky a oddíl page.
 */
class ClimbingProgramResource extends Resource
{
    protected static ?string $model = ClimbingProgram::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Programy';

    protected static ?string $modelLabel = 'Program';

    protected static ?string $pluralModelLabel = 'Programy';

    protected static ?string $cluster = Programs::class;

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'title';

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                TextInput::make('title')
                    ->label('Název programu')
                    ->required()
                    ->maxLength(120),

                TextInput::make('subtitle')
                    ->label('Podtitul')
                    ->maxLength(160),
            ]),

            Textarea::make('description')
                ->label('Popis')
                ->required()
                ->rows(4)
                ->maxLength(1500)
                ->columnSpanFull(),

            Repeater::make('bullets')
                ->label('Odrážky')
                ->helperText('Krátké body uvedené pod popisem.')
                ->schema([
                    TextInput::make('text')
                        ->label('Text')
                        ->required()
                        ->maxLength(160),
                ])
                ->defaultItems(4)
                ->reorderable()
                ->collapsible()
                ->itemLabel(fn (array $state): ?string => $state['text'] ?? null)
                ->columnSpanFull(),

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

                Tables\Columns\TextColumn::make('title')
                    ->label('Název')
                    ->searchable(),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Podtitul')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publ.')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')->label('Publikováno'),
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
            'index' => Pages\ListClimbingPrograms::route('/'),
            'create' => Pages\CreateClimbingProgram::route('/create'),
            'edit' => Pages\EditClimbingProgram::route('/{record}/edit'),
        ];
    }
}
