<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic_info')
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('password')->password()->required(),
                    ]),

                Section::make('Location')
                    ->schema([
                        Select::make('country_id')
                            ->label('Country')
                            ->options(Country::pluck('name', 'id'))
                            ->reactive()
                            ->afterStateUpdated(function(callable $set){
                                $set('state_id',null);
                                $set('city_id',null);

                            }),
                        Select::make('state_id')
                            ->label('State')
                            ->options(function (callable $get) {
                                $country = $get('country_id');
                                if (!$country) {
                                    return [];
                                } else {
                                    return State::whereCountryId($country)
                                        ->pluck('name', 'id');
                                }
                            })->reactive()
                            ->afterStateUpdated(function (callable $set) {
                                $set('city_id', null);
                            }),
                        Select::make('city_id')
                            ->label('City')
                            ->options(function (callable $get) {
                                $city = $get('state_id');
                                if (!$city) {
                                    return [];
                                } else {
                                    return City::whereStateId($city)
                                        ->pluck('name', 'id');
                                }
                            })->reactive(),
                    ])

            ]);
    }
}
