<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DishResource\Pages;
use App\Filament\Resources\DishResource\RelationManagers;
use App\Models\Category;
use App\Models\Dish;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DishResource extends Resource
{
    protected static ?string $model = Dish::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Меню';
    protected static ?string $modelLabel = "Блюда";
    protected static ?string $pluralModelLabel = "Блюда";

    public static function form(Form $form): Form
    {
        return $form->schema([
            SpatieMediaLibraryFileUpload::make('image')
                ->image()
                ->label('Изображение')
                ->collection('image'),

            Forms\Components\TextInput::make('title')
                ->label('Название')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('description')
                ->label('Описание')
                ->nullable()
                ->required(),

            Forms\Components\TextInput::make('price')
                ->label('Цена')
                ->maxLength(255)
                ->required(),

            Forms\Components\TextInput::make('weight')
                ->label('Вес')
                ->maxLength(255)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('weight'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDishes::route('/'),
        ];
    }
}

