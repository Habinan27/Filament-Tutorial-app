<?php

namespace App\Filament\Resources\Countries;

use App\Filament\Resources\Countries\Pages\CreateCountry;
use App\Filament\Resources\Countries\Pages\EditCountry;
use App\Filament\Resources\Countries\Pages\ListCountries;
use App\Filament\Resources\Countries\Schemas\CountryForm;
use App\Filament\Resources\Countries\Tables\CountriesTable;
use App\Models\Country;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AdjustmentsHorizontal;

    protected static ?string $recordTitleAttribute = 'name';

    //make navigation group
    protected static string|\UnitEnum|null $navigationGroup = 'Locations';

    //custom navigation label
    protected static ?string $navigationLabel = 'Manage Countries';

    //create sort navigation order
    protected static ?int $navigationSort = 3;

    //add navigation badge with count of records
    public static function getNavigationBadge(): ?string
    {
        return Country::count();
    }

    //change navigation badge color
    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }

    public static function form(Schema $schema): Schema
    {
        return CountryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CountriesTable::configure($table);
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
            'index' => ListCountries::route('/'),
            'create' => CreateCountry::route('/create'),
            'edit' => EditCountry::route('/{record}/edit'),
        ];
    }
}
