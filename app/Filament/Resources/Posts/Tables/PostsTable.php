<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;


class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->toggleable(isToggledHiddenByDefault:true),
                ImageColumn::make('image')->disk('public')->width(60),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('category.name')->sortable()->searchable(),
                ColorColumn::make('color')->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
                TextColumn::make('tags')->label('Tags')->badge()->toggleable(isToggledHiddenByDefault:true),
                IconColumn::make('published')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault:true)
            ])->defaultSort('title','asc')
            ->filters([
                Filter::make('created_at')
                    ->label('Created At')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Select Date:')
                    ])
                    ->query(function($query,$data){
                        return $query
                            ->when($data['created_at'],function($q,$data){
                                $q->whereDate('created_at',$data);
                            });
                    }),
                    SelectFilter::make('category_id')
                        ->label('Select Category')
                        ->relationship('category','name')
                        ->preload(),

                    TrashedFilter::make()

            ])
            ->recordActions([
                Action::make('status')
                    ->label('Status change')
                    ->icon(Heroicon::AcademicCap)
                    ->schema([
                        Checkbox::make('published')
                    ])
                    ->action(function(array $data,$record){
                        $record->published = $data['published'];
                        $record->save();
                    }),

                EditAction::make(),
                DeleteAction::make(),
                ViewAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
