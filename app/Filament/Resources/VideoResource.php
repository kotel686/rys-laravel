<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Filament resource for managing videos shown in the public media gallery.
 */
class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-film';

    protected static ?string $navigationLabel = 'Videa';

    protected static ?string $modelLabel = 'Video';

    protected static ?string $pluralModelLabel = 'Videa';

    protected static ?int $navigationSort = 30;

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

            Forms\Components\Textarea::make('description')
                ->label('Popis')
                ->rows(3)
                ->maxLength(2000)
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('video_path')
                ->label('Video soubor')
                ->disk('public')
                ->directory('videos')
                ->visibility('public')
                ->maxSize(200 * 1024)
                ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/quicktime'])
                ->required(),

            Forms\Components\FileUpload::make('poster_path')
                ->label('Náhledový obrázek (poster)')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('videos/posters')
                ->visibility('public')
                ->maxSize(4 * 1024)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

            Forms\Components\Grid::make(3)->schema([
                Forms\Components\TextInput::make('duration')
                    ->label('Délka (např. 01:23)')
                    ->maxLength(16),

                Forms\Components\TextInput::make('sort_order')
                    ->label('Pořadí')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Forms\Components\Toggle::make('is_published')
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
                Tables\Columns\ImageColumn::make('poster_path')
                    ->label('Náhled')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Název')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Délka'),

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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
