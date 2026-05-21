<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ClimbingPostResource\Pages;
use App\Models\ClimbingPost;
use BackedEnum;
use UnitEnum;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

/**
 * Filament resource for managing news / aktuality posts for the
 * Lezecká stěna mini-site.
 */
class ClimbingPostResource extends Resource
{
    protected static ?string $model = ClimbingPost::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Lezecká stěna – Aktuality';

    protected static ?string $modelLabel = 'Aktualita';

    protected static ?string $pluralModelLabel = 'Aktuality';

    protected static string|UnitEnum|null $navigationGroup = 'Lezecká stěna';

    protected static ?int $navigationSort = 60;

    protected static ?string $recordTitleAttribute = 'title';

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Titulek')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(function (string $state, callable $set, ?string $context, ?ClimbingPost $record): void {
                    if ($context === 'create' || ($record !== null && empty($record->slug))) {
                        $set('slug', Str::slug($state));
                    }
                }),

            Grid::make(2)->schema([
                TextInput::make('slug')
                    ->label('URL slug')
                    ->helperText('Část URL adresy. Automaticky se vytvoří z titulku.')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->alphaDash(),

                DateTimePicker::make('published_at')
                    ->label('Publikováno')
                    ->helperText('Volitelné. Pokud necháte prázdné, použije se čas vytvoření.')
                    ->seconds(false),
            ]),

            FileUpload::make('image_path')
                ->label('Úvodní obrázek')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('climbing/posts')
                ->visibility('public')
                ->maxSize(8 * 1024)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

            Textarea::make('excerpt')
                ->label('Perex')
                ->helperText('Krátký úvod, který se zobrazí v seznamu aktualit.')
                ->rows(3)
                ->maxLength(500)
                ->columnSpanFull(),

            RichEditor::make('content')
                ->label('Obsah')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'strike',
                    'h1',
                    'h2',
                    'h3',
                    'blockquote',
                    'bulletList',
                    'orderedList',
                    'link',
                    'codeBlock',
                    'undo',
                    'redo',
                ])
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
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titulek')
                    ->searchable()
                    ->sortable()
                    ->limit(60),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->toggleable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publikováno')
                    ->dateTime('j. n. Y H:i')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publ.')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')->label('Publikováno'),
            ])
            ->actions([
                Actions\Action::make('view')
                    ->label('Otevřít článek')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('gray')
                    ->url(fn (ClimbingPost $record): string => route('climbing.news.show', $record))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListClimbingPosts::route('/'),
            'create' => Pages\CreateClimbingPost::route('/create'),
            'edit' => Pages\EditClimbingPost::route('/{record}/edit'),
        ];
    }
}
