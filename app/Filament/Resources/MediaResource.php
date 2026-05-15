<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Models\Media;
use BackedEnum;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Filament resource for managing media (photos and videos) shown in the
 * public Galerie section. The user picks the type via a toggle and the form
 * surfaces the relevant upload fields.
 */
class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Fotky a videa';

    protected static ?string $modelLabel = 'Položka galerie';

    protected static ?string $pluralModelLabel = 'Fotky a videa';

    protected static ?int $navigationSort = 20;

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            ToggleButtons::make('type')
                ->label('Typ')
                ->options([
                    Media::TYPE_IMAGE => 'Fotka',
                    Media::TYPE_VIDEO => 'Video',
                ])
                ->icons([
                    Media::TYPE_IMAGE => 'heroicon-o-photo',
                    Media::TYPE_VIDEO => 'heroicon-o-film',
                ])
                ->colors([
                    Media::TYPE_IMAGE => 'primary',
                    Media::TYPE_VIDEO => 'danger',
                ])
                ->inline()
                ->default(Media::TYPE_IMAGE)
                ->required()
                ->live(),

            TextInput::make('title')
                ->label('Název')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->label('Popis')
                ->rows(3)
                ->maxLength(2000)
                ->columnSpanFull(),

            FileUpload::make('file_path')
                ->label(fn (Get $get): string => $get('type') === Media::TYPE_VIDEO
                    ? 'Video soubor'
                    : 'Fotografie')
                ->disk('public')
                ->directory(fn (Get $get): string => $get('type') === Media::TYPE_VIDEO
                    ? 'videos'
                    : 'photos')
                ->visibility('public')
                ->image(fn (Get $get): bool => $get('type') !== Media::TYPE_VIDEO)
                ->imageEditor(fn (Get $get): bool => $get('type') !== Media::TYPE_VIDEO)
                ->maxSize(fn (Get $get): int => $get('type') === Media::TYPE_VIDEO
                    ? 200 * 1024
                    : 8 * 1024)
                ->acceptedFileTypes(fn (Get $get): array => $get('type') === Media::TYPE_VIDEO
                    ? ['video/mp4', 'video/webm', 'video/quicktime']
                    : ['image/jpeg', 'image/png', 'image/webp'])
                ->required(),

            FileUpload::make('poster_path')
                ->label('Náhledový obrázek (poster)')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('videos/posters')
                ->visibility('public')
                ->maxSize(4 * 1024)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                ->visible(fn (Get $get): bool => $get('type') === Media::TYPE_VIDEO),

            Grid::make(3)->schema([
                TextInput::make('duration')
                    ->label('Délka (např. 01:23)')
                    ->maxLength(16)
                    ->visible(fn (Get $get): bool => $get('type') === Media::TYPE_VIDEO),

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
                Tables\Columns\ImageColumn::make('preview')
                    ->label('Náhled')
                    ->disk('public')
                    ->state(fn (Media $record): ?string => $record->isVideo()
                        ? $record->poster_path
                        : $record->file_path)
                    ->square(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Typ')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === Media::TYPE_VIDEO ? 'Video' : 'Fotka')
                    ->color(fn (string $state): string => $state === Media::TYPE_VIDEO ? 'danger' : 'primary')
                    ->icon(fn (string $state): string => $state === Media::TYPE_VIDEO ? 'heroicon-o-film' : 'heroicon-o-photo'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Název')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Délka')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publik.')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Pořadí')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Typ')
                    ->options([
                        Media::TYPE_IMAGE => 'Fotka',
                        Media::TYPE_VIDEO => 'Video',
                    ]),
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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
