<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoResource\Pages;
use App\Models\Photo;
use BackedEnum;
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
 * Filament resource for managing photos shown in the public media gallery.
 */
class PhotoResource extends Resource
{
    protected static ?string $model = Photo::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Fotky';

    protected static ?string $modelLabel = 'Foto';

    protected static ?string $pluralModelLabel = 'Fotky';

    protected static ?int $navigationSort = 20;

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

            Textarea::make('description')
                ->label('Popis')
                ->rows(3)
                ->maxLength(2000)
                ->columnSpanFull(),

            FileUpload::make('image_path')
                ->label('Fotografie')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('photos')
                ->visibility('public')
                ->maxSize(8 * 1024)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->required(),

            Grid::make(2)->schema([
                TextInput::make('sort_order')
                    ->label('Pořadí')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Toggle::make('is_published')
                    ->label('Publikováno')
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
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Název')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publik.')
                    ->boolean(),

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
            'index' => Pages\ListPhotos::route('/'),
            'create' => Pages\CreatePhoto::route('/create'),
            'edit' => Pages\EditPhoto::route('/{record}/edit'),
        ];
    }
}
