<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ClimbingSettingResource\Pages;
use App\Models\ClimbingSetting;
use BackedEnum;
use UnitEnum;
use Filament\Actions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Filament resource for editing the free-text snippets used on the
 * Lezecká stěna mini-site (e.g. the "Náš příběh" story on /o-stene).
 *
 * Records are seeded with a fixed set of keys – the admin is expected to
 * edit existing rows rather than create new ones.
 */
class ClimbingSettingResource extends Resource
{
    protected static ?string $model = ClimbingSetting::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Lezecká stěna – Texty';

    protected static ?string $modelLabel = 'Text na stránce';

    protected static ?string $pluralModelLabel = 'Texty na stránkách';

    protected static string|UnitEnum|null $navigationGroup = 'Lezecká stěna';

    protected static ?int $navigationSort = 30;

    protected static ?string $recordTitleAttribute = 'label';

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('label')
                ->label('Popis textu')
                ->helperText('Pomocný název – kde se text na webu zobrazuje.')
                ->required()
                ->maxLength(160),

            TextInput::make('key')
                ->label('Klíč (technický)')
                ->helperText('Identifikátor, na který odkazuje Blade šablona. Měňte pouze pokud víte, co děláte.')
                ->required()
                ->unique(ignoreRecord: true)
                ->disabledOn('edit')
                ->maxLength(120),

            RichEditor::make('value')
                ->label('Obsah')
                ->toolbarButtons([
                    'bold', 'italic', 'underline', 'strike',
                    'h2', 'h3',
                    'blockquote', 'bulletList', 'orderedList',
                    'link', 'undo', 'redo',
                ])
                ->columnSpanFull(),
        ]);
    }

    /**
     * Build the listing table.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Popis textu')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('key')
                    ->label('Klíč')
                    ->toggleable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Naposledy upraveno')
                    ->dateTime('j. n. Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('label')
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    /**
     * Resource pages.
     *
     * @return array<string, mixed>
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClimbingSettings::route('/'),
            'edit' => Pages\EditClimbingSetting::route('/{record}/edit'),
        ];
    }
}
