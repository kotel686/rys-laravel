<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Filament resource for managing public reference projects.
 */
class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Reference';

    protected static ?string $modelLabel = 'Reference';

    protected static ?string $pluralModelLabel = 'Reference';

    protected static ?int $navigationSort = 10;

    /**
     * Build the create/edit form.
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Název')
                ->required()
                ->maxLength(255),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('location')
                    ->label('Lokalita')
                    ->maxLength(255),

                Forms\Components\TextInput::make('type')
                    ->label('Typ práce')
                    ->maxLength(255),
            ]),

            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('year')
                    ->label('Rok')
                    ->numeric()
                    ->minValue(1990)
                    ->maxValue(2100),

                Forms\Components\TextInput::make('sort_order')
                    ->label('Pořadí')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]),

            Forms\Components\FileUpload::make('image_path')
                ->label('Fotografie')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('projects')
                ->visibility('public')
                ->maxSize(8 * 1024)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->required(),

            Forms\Components\Textarea::make('description')
                ->label('Popis')
                ->rows(4)
                ->maxLength(2000)
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_published')
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
