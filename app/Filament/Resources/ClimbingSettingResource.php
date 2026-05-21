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

    protected static ?string $navigationLabel = 'Úvodní text';

    protected static ?string $modelLabel = 'Úvodní text';

    protected static ?string $pluralModelLabel = 'Úvodní text';

    protected static string|UnitEnum|null $navigationGroup = 'Stěna – O stěně';

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'label';

    /**
     * Build the edit form. The single seeded row is edited only – no
     * `key` field is exposed since it's a technical identifier wired to
     * the Blade template.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            RichEditor::make('value')
                ->label('Úvodní text na stránce O stěně')
                ->helperText('Zobrazuje se hned pod nadpisem "Náš příběh" na /lezeckastena/o-stene.')
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
                    ->label('Co se edituje'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Naposledy upraveno')
                    ->dateTime('j. n. Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Actions\EditAction::make()->label('Upravit text'),
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
