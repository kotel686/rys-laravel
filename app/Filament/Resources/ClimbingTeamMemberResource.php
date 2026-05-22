<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Clusters\AboutWall;
use App\Filament\Resources\ClimbingTeamMemberResource\Pages;
use App\Models\ClimbingTeamMember;
use BackedEnum;
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
 * Filament resource for managing team members on the O stěně page.
 */
class ClimbingTeamMemberResource extends Resource
{
    protected static ?string $model = ClimbingTeamMember::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationLabel = 'Tým';

    protected static ?string $modelLabel = 'Člen týmu';

    protected static ?string $pluralModelLabel = 'Tým';

    protected static ?string $cluster = AboutWall::class;

    protected static ?int $navigationSort = 20;

    protected static ?string $recordTitleAttribute = 'name';

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                TextInput::make('name')
                    ->label('Jméno')
                    ->required()
                    ->maxLength(120),

                TextInput::make('role')
                    ->label('Role / pozice')
                    ->maxLength(120),
            ]),

            Textarea::make('bio')
                ->label('Krátký popis')
                ->rows(4)
                ->maxLength(1000)
                ->columnSpanFull(),

            FileUpload::make('image_path')
                ->label('Portrétní fotka')
                ->helperText('Volitelné. Pokud není nahrána, zobrazí se kruh s iniciálami.')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('climbing/team')
                ->visibility('public')
                ->maxSize(5 * 1024)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']),

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
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Jméno')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publ.')
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
            'index' => Pages\ListClimbingTeamMembers::route('/'),
            'create' => Pages\CreateClimbingTeamMember::route('/create'),
            'edit' => Pages\EditClimbingTeamMember::route('/{record}/edit'),
        ];
    }
}
