<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use App\Models\Order;

class OrdersCountWidget extends ChartWidget
{
    protected static ?string $heading = 'Статистика заказов по месяцам';
    protected static string $color = 'info';

    protected static array $monthes = [
        "Январь"   => 1,
        "Февраль"  => 2,
        "Март"     => 3,
        "Апрель"   => 4,
        "Май"      => 5,
        "Июнь"     => 6,
        "Июль"     => 7,
        "Август"   => 8,
        "Сентябрь" => 9,
        "Октябрь"  => 10,
        "Ноябрь"   => 11,
        "Декабрь"  => 12
    ];

    protected static ?int $sort = 3;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Количество заказов',
                    'data'  => self::getOrdersData(),
                    'fill'  => 'start',
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                ],
            ],
            'labels'   => array_keys(self::$monthes),
        ];
    }

    private static function getOrdersData(): array
    {
        $counts = [];

        foreach (self::$monthes as $month => $value) {
            $startDate = Carbon::createFromDate(now()->year, $value, 1)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();

            $counts[] = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        }

        return $counts;
    }
}
