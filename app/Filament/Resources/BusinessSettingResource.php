<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessSettingResource\Pages;
use App\Models\BusinessSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BusinessSettingResource extends Resource
{
    protected static $model = BusinessSetting::class;

    protected static $navigationIcon = 'heroicon-o-cog';
    protected static $navigationGroup = 'Business Management';
    protected static $navigationSort = 3;

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
            'index' => Pages\ListBusinessSettings::route('/'),
            'create' => Pages\CreateBusinessSetting::route('/create'),
            'edit' => Pages\EditBusinessSetting::route('/{record}/edit'),
        ];
    }
}
