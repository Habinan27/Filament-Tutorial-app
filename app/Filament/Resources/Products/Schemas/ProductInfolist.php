<?php

namespace App\Filament\Resources\Products\Schemas;

use Dom\Text;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Product Information')
                            ->icon(Heroicon::AcademicCap)
                            ->schema([
                                TextEntry::make('id')
                                    ->label('Product id')
                                    ->weight('bold')
                                    ->color('primary'),
                                TextEntry::make('name')
                                    ->label('Product name')
                                    ->weight('bold')
                                    ->color('primary'),
                                TextEntry::make('sku')
                                    ->label('Product sku')
                                    ->weight('bold')
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('description')
                                    ->label('Product description')
                                    ->weight('bold')
                                    ->color('primary'),
                                TextEntry::make('created_at')
                                    ->label('Product Created Date')
                                    ->weight('bold')
                                    ->color('info')
                                    ->date('d/m/Y'),

                            ]),
                        Tab::make('Pricing & Stocks')
                            ->icon(Heroicon::CurrencyDollar)
                            ->schema([
                                TextEntry::make('price')
                                    ->icon(Heroicon::CurrencyDollar)
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary'),
                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->weight('bold')
                                    ->color('success'),
                            ]),
                        Tab::make('Media & Status')
                            ->icon(Heroicon::Photo)
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),
                                IconEntry::make('is_active')
                                    ->label('Is Active?')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Is Featured?')
                                    ->boolean(),
                            ])
                    ])->columnSpanFull()->vertical(),
            ]);
    }
}
