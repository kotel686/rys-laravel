<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ClimbingPaymentResource\Pages;
use App\Models\ClimbingPayment;
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
 * Filament resource for QR-payment cards shown on the Ceník page.
 *
 * Admin uploads a QR code image (typically exported from their banking
 * app as PNG / SVG), adds a title (e.g. "Permanentka 10 vstupů") and an
 * optional description (account number, variable symbol, amount …).
 */
class ClimbingPaymentResource extends Resource
{
    protected static ?string $model = ClimbingPayment::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-qr-code';

    protected static ?string $navigationLabel = 'QR platby';

    protected static ?string $modelLabel = 'QR platba';

    protected static ?string $pluralModelLabel = 'QR platby';

    protected static string|UnitEnum|null $navigationGroup = 'Stěna – Ceník';

    protected static ?int $navigationSort = 20;

    protected static ?string $recordTitleAttribute = 'title';

    /**
     * Build the create/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Nadpis')
                ->helperText('Např. „Permanentka 10 vstupů" nebo „Kroužek – pololetní platba".')
                ->required()
                ->maxLength(160),

            FileUpload::make('image_path')
                ->label('Obrázek QR kódu')
                ->helperText('PNG, JPEG, WebP nebo SVG. QR kód si vyexportujte z aplikace své banky.')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('climbing/payments')
                ->visibility('public')
                ->maxSize(3 * 1024)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                ->required(),

            Textarea::make('description')
                ->label('Popis')
                ->helperText('Volitelné. Např. číslo účtu, variabilní symbol, částka.')
                ->rows(3)
                ->maxLength(1000)
                ->columnSpanFull(),

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
                    ->label('QR')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Nadpis')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publ.')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
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
            'index' => Pages\ListClimbingPayments::route('/'),
            'create' => Pages\CreateClimbingPayment::route('/create'),
            'edit' => Pages\EditClimbingPayment::route('/{record}/edit'),
        ];
    }
}
