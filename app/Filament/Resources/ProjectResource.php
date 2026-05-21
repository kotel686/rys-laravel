<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use BackedEnum;
use UnitEnum;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Filament resource for managing public reference projects.
 */
class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Reference';

    protected static ?string $modelLabel = 'Reference';

    protected static ?string $pluralModelLabel = 'Reference';

    protected static string|UnitEnum|null $navigationGroup = 'Výškové práce';

    protected static ?int $navigationSort = 10;

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Název')
                ->required()
                ->maxLength(255),

            Grid::make(2)->schema([
                TextInput::make('location')
                    ->label('Lokalita')
                    ->maxLength(255),

                TextInput::make('type')
                    ->label('Typ práce')
                    ->maxLength(255),
            ]),

            Grid::make(2)->schema([
                TextInput::make('year')
                    ->label('Rok')
                    ->numeric()
                    ->minValue(1990)
                    ->maxValue(2100),

                TextInput::make('sort_order')
                    ->label('Pořadí')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]),

            FileUpload::make('image_path')
                ->label('Fotografie')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('projects')
                ->visibility('public')
                ->maxSize(8 * 1024)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->required(),

            Textarea::make('description')
                ->label('Popis')
                ->rows(4)
                ->maxLength(2000)
                ->columnSpanFull(),

            Toggle::make('is_published')
                ->label('Publikováno')
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
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Název')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokalita')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Typ')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('year')
                    ->label('Rok')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publik.')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Pořadí')
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
