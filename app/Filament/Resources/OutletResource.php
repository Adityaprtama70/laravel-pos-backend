<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutletResource\Pages;
use App\Models\Outlet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use BackedEnum;
use UnitEnum;

class OutletResource extends Resource
{
    protected static ?string $model = Outlet::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-storefront';
    protected static string|UnitEnum|null $navigationGroup = 'Business Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        // Left Column
                        Forms\Components\Section::make('Outlet Information')
                            ->columnSpan(1)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Outlet Name')
                                    ->required()
                                    ->placeholder('e.g., Cabang Jakarta Selatan'),

                                Forms\Components\Select::make('company_id')
                                    ->relationship('company', 'name')
                                    ->label('Business')
                                    ->placeholder('Toko Kelontong Manis Jaya')
                                    ->searchable()
                                    ->preload()
                                    ->clearable(),
                            ]),

                        // Right Column
                        Forms\Components\Section::make('Contact & Location')
                            ->columnSpan(1)
                            ->schema([
                                Forms\Components\Textarea::make('address')
                                    ->label('Address')
                                    ->rows(3),

                                Forms\Components\TextInput::make('phone')
                                    ->label('Phone Number')
                                    ->placeholder('+62 xxx xxxx xxxx'),

                                Forms\Components\Textarea::make('description')
                                    ->label('Description')
                                    ->rows(3),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company.name')
                    ->label('Business')
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOutlets::route('/'),
            'create' => Pages\CreateOutlet::route('/create'),
            'edit' => Pages\EditOutlet::route('/{record}/edit'),
        ];
    }
}
