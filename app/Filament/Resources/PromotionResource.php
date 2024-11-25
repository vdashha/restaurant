<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables;
use Filament\Resources\Resource;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Marketing';
    protected static ?string $modelLabel = "Акция";
    protected static ?string $pluralModelLabel = "Акции";

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            SpatieMediaLibraryFileUpload::make('image')
                ->image()
            ->label('Изображение')->collection('image'),
            Forms\Components\TextInput::make('title')
                ->label('Название')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->required()
                ->label('Описание')
                ->maxLength(500),

            Forms\Components\DatePicker::make('start_date')
                ->label('Дата начала')
                ->nullable(),

            Forms\Components\DatePicker::make('end_date')
                ->label('Дата окончания')
                ->nullable(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('start_date'),
                Tables\Columns\TextColumn::make('end_date'),
                Tables\Columns\TextColumn::make('created_at')->date(),
                Tables\Columns\TextColumn::make('updated_at')->date(),
            ])
            ->filters([
                // Можно добавить фильтры, если необходимо
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromotions::route('/'),
        ];
    }
}
