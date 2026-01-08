<?php

namespace App\Filament\Resources\Companies;

use App\Filament\Resources\Companies\Pages\EditCompany;
use App\Filament\Resources\Companies\Pages\ViewCompany;
use App\Filament\Resources\Companies\Schemas\CompanyForm;
use App\Filament\Resources\Companies\Schemas\CompanyInfolist;
use App\Models\Company;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use UnitEnum;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static UnitEnum|string|null $navigationGroup = 'Business Management';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Businesses';

    public static function form(Schema $schema): Schema
    {
        return CompanyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompanyInfolist::configure($schema);
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
            'index' => ViewCompany::route('/{record?}'),
            'edit' => EditCompany::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        $company = Company::first();
        if ($company) {
            return static::getUrl('index', ['record' => $company]);
        }

        return static::getUrl('index');
    }
}
