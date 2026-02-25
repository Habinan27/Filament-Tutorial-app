<?php

namespace App\Filament\Resources\Posts\Schemas;

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Validation\Rules\Unique;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post Details')
                    ->description('Manage the post details')
                    ->schema([
                        TextInput::make('title')->rules(['required','max:15','min:5']),
                        TextInput::make('slug')->unique()->validationMessages([
                            'unique' => 'slug should be unique'
                        ]),
                        Select::make('category_id')
                            ->label('Category')
                            ->options(Category::all()->pluck('name', 'id')),
                        ColorPicker::make('color'),
                        MarkdownEditor::make('body'),
                    ])->columnSpan(2),
                Group::make()
                    ->schema([
                        Section::make('Image Upload')
                            ->description('Upload an image for the post')
                            ->icon(Heroicon::RocketLaunch)
                            ->schema([
                                FileUpload::make('image')->disk('public')->directory('posts'),
                            ]),
                        Section::make('Meta')
                            ->description('Manage the post meta information')
                            ->icon(Heroicon::Cog6Tooth)
                            ->schema([
                                TagsInput::make('tags'),
                                Checkbox::make('published'),
                                DatePicker::make('published_at'),
                            ]),
                    ])->columnSpan(1)


            ])->columns(3);
            
    }
}
