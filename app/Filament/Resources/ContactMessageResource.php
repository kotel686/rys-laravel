<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use BackedEnum;
use Filament\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

/**
 * Filament resource for inspecting contact-form submissions.
 *
 * Records are read-only: created from the public form, then the admin can
 * mark them as handled or delete them.
 */
class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Poptávky';

    protected static ?string $modelLabel = 'Poptávka';

    protected static ?string $pluralModelLabel = 'Poptávky';

    protected static ?int $navigationSort = 1;

    /**
     * Surface unhandled submissions on the sidebar so the admin notices new
     * messages at a glance.
     */
    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::query()->whereNull('handled_at')->count();

        return $count > 0 ? (string) $count : null;
    }

    /**
     * Build the (read-only) view/edit form.
     */
    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                TextInput::make('name')
                    ->label('Jméno')
                    ->disabled(),

                TextInput::make('email')
                    ->label('E-mail')
                    ->disabled(),

                TextInput::make('phone')
                    ->label('Telefon')
                    ->disabled(),

                TextInput::make('ip_address')
                    ->label('IP adresa')
                    ->disabled(),
            ]),

            Textarea::make('message')
                ->label('Zpráva')
                ->rows(8)
                ->disabled()
                ->columnSpanFull(),

            Grid::make(2)->schema([
                TextInput::make('created_at')
                    ->label('Přijato')
                    ->disabled(),

                TextInput::make('handled_at')
                    ->label('Vyřízeno')
                    ->disabled(),
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
                Tables\Columns\IconColumn::make('handled_at')
                    ->label('Stav')
                    ->icon(fn ($state): string => $state ? 'heroicon-o-check-circle' : 'heroicon-o-inbox')
                    ->color(fn ($state): string => $state ? 'success' : 'warning')
                    ->tooltip(fn ($state): string => $state ? 'Vyřízeno' : 'Nevyřízeno'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Přijato')
                    ->dateTime('d. m. Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Jméno')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telefon')
                    ->copyable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('message')
                    ->label('Zpráva')
                    ->limit(60)
                    ->wrap()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\Filter::make('unhandled')
                    ->label('Pouze nevyřízené')
                    ->query(fn (Builder $query): Builder => $query->whereNull('handled_at'))
                    ->default(),
            ])
            ->actions([
                Actions\Action::make('markHandled')
                    ->label('Označit jako vyřízeno')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (ContactMessage $record): bool => ! $record->isHandled())
                    ->action(fn (ContactMessage $record) => $record->update(['handled_at' => now()])),

                Actions\Action::make('markUnhandled')
                    ->label('Vrátit do nevyřízených')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('warning')
                    ->visible(fn (ContactMessage $record): bool => $record->isHandled())
                    ->action(fn (ContactMessage $record) => $record->update(['handled_at' => null])),

                Actions\ViewAction::make()->label('Detail'),
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
            'index' => Pages\ListContactMessages::route('/'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
        ];
    }
}
