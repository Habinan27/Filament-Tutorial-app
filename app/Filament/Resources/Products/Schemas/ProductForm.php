<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Information')
                        ->description('Fill the Product Information')
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make('name')->required(),
                                    TextInput::make('sku')->required(),
                                ])->columns(2),
                            MarkdownEditor::make('description'),
                        ]),
                        Step::make('Pricing & Stock')
                        ->description('Fill the Pricing & Stock')
                        ->schema([
                            Group::make()
                            ->schema([
                                TextInput::make('stock')->numeric()->required(),
                                TextInput::make('price')->numeric()->required(),
                            ])->columns(2),
                        ]),
                        Step::make('Media & Status')
                            ->description('Fill the Media & Status')
                            ->schema([
                                FileUpload::make('image')->disk('public')->directory('products'),
                                Checkbox::make('is_active'),
                                Checkbox::make('is_featured'),
                            ])
                ])->columnSpanFull()
                ->skippable()
                ->submitAction(
                    Action::make('save')
                        ->label('save product')
                        ->button()
                        ->color('primary')
                        ->submit('save')
                )
            ]);
    }
}
