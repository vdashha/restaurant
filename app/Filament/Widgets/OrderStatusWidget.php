<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class OrderStatusWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Всего заказов', Order::count())
                ->description('Общее количество всех заказов')
                ->color('success'),

            Card::make('Новые заказы', Order::where('status', 'new')->count())
                ->description('Заказы со статусом "Новый"')
                ->color('info'),

            Card::make('Общая сумма заказов', number_format(Order::sum('total_price'), 2) . ' BYN')
                ->description('Сумма всех заказов')
                ->color('warning'),

            Card::make('Оплачено картой', Order::where('payment', 'card')->count())
                ->description('Количество заказов оплаченных картой')
                ->color('primary'),

            Card::make('Оплачено наличными', Order::where('payment', 'cash')->count())
                ->description('Количество заказов оплаченных наличными')
                ->color('gray'),

            Card::make('Средняя стоимость заказа', number_format(Order::avg('total_price'), 2) . ' BYN')
                ->description('Средняя стоимость всех заказов')
                ->color('gray'),
        ];
    }
}
