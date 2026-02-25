<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->rules(['required','max:15','min:5'])->unique()->validationMessages([
                    'unique' => 'this name is already taken'
                ]),
                TextInput::make('slug')->rules(['required','max:15','min:5'])->unique()->validationMessages([
                    'unique' => 'this slug is already taken'
                ]),
            ]);
    }
}
