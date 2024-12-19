<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentMethodEnum;
use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Restaurant;
use App\Repositories\RestaurantRepository;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = "Заказы";
    protected static ?string $pluralModelLabel = "Заказы";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    TextInput::make('name')
                        ->label('Имя')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('phone_number')
                        ->label('Номер телефона')
                        ->required(),

                    TextInput::make('total_price')
                        ->label('Сумма заказа')
                        ->numeric()
                        ->required(),

                    DateTimePicker::make('time')
                        ->label('Время')
                        ->required(),

                    Select::make('payment')
                        ->label('Способ оплаты')
                        ->options(PaymentMethodEnum::class)
                        ->required(),

                    Select::make('adress')
                        ->label('Адрес ресторана')
                        ->options(Restaurant::all()->pluck('address', 'id'))
                        ->required(),

                ]),

                Textarea::make('comment')
                    ->label('Комментарий')
                    ->columnSpanFull()
                    ->maxLength(1000),

                Select::make('status')
                    ->label('Статус')
                    ->options(OrderStatusEnum::class)
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('payment')
                    ->label('Оплата')
                    ->formatStateUsing(fn (PaymentMethodEnum $state): string => $state->getLabel()),
                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->badge(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('phone_number')->searchable(),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('total_price'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(OrderStatusEnum::options()),
                Tables\Filters\SelectFilter::make('adress')
                    ->options(Restaurant::all()->pluck('address', 'id'))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
