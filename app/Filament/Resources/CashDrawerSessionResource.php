<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CashDrawerSessionResource\Pages;
use App\Models\CashDrawerSession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CashDrawerSessionResource extends Resource
{
    protected static $model = CashDrawerSession::class;

    protected static $navigationIcon = 'heroicon-o-inbox-stack';
    protected static $navigationGroup = 'Sales & Orders';
    protected static $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
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
