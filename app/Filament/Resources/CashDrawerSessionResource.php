<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CashDrawerSessionResource\Pages;
use App\Models\CashDrawerSession;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use BackedEnum;
use UnitEnum;

class CashDrawerSessionResource extends Resource
{
    protected static ?string $model = CashDrawerSession::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-inbox-stack';
    protected static string|UnitEnum|null $navigationGroup = 'Sales & Orders';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCashDrawerSessions::route('/'),
            'create' => Pages\CreateCashDrawerSession::route('/create'),
            'edit' => Pages\EditCashDrawerSession::route('/{record}/edit'),
        ];
    }
}


