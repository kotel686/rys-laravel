<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Clusters\AboutWall;
use App\Filament\Resources\ClimbingGalleryImageResource\Pages;
use App\Models\ClimbingGalleryImage;
use BackedEnum;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Filament resource for managing the PhotoSwipe gallery that appears on
 * the /lezeckastena home page. Sits inside the "O stěně" cluster so the
 * sidebar stays organised under Lezecká stěna.
 */
class ClimbingGalleryImageResource extends Resource
{
    protected static ?string $model = ClimbingGalleryImage::class;

    protected static ?string $cluster = AboutWall::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Galerie na úvodu';

    protected static ?string $modelLabel = 'Fotka galerie';

    protected static ?string $pluralModelLabel = 'Galerie na úvodu';

    protected static ?int $navigationSort = 50;

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('image_path')
                ->label('Fotografie')
                ->disk('public')
                ->directory('climbing/gallery')
                ->visibility('public')
                ->image()
                ->imageEditor()
                ->maxSize(8 * 1024)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->required()
                ->columnSpanFull(),

            TextInput::make('alt')
                ->label('Popis (alt text)')
                ->helperText('Krátký popis pro čtečky obrazovky a SEO. Nepovinné.')
                ->maxLength(255)
                ->columnSpanFull(),

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
                    ->label('Náhled')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('alt')
                    ->label('Popis')
                    ->limit(60)
                    ->searchable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Pořadí')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publik.')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Přidáno')
                    ->dateTime('d. m. Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListClimbingGalleryImages::route('/'),
            'create' => Pages\CreateClimbingGalleryImage::route('/create'),
            'edit' => Pages\EditClimbingGalleryImage::route('/{record}/edit'),
        ];
    }
}
