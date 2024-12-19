<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Number;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class OrdersChartWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            $this->getPostalItemStat(),
        ];
    }

    private static function getFormat($number): string
    {
        if ($number < 1000) {
            return (string) Number::format($number, 0);
        }

        if ($number < 1000000) {
            return Number::format($number / 1000, 2) . 'т';
        }

        return Number::format($number / 1000000, 2) . 'м';
    }

    private function getMonthlyCount(Builder $query, ?Carbon $date = null): int
    {
        $date = $date ?? now();

        $firstDayOfMonth = $date->startOfMonth();
        $lastDayOfMonth = $date->copy()->endOfMonth();

        return $query->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])->count();
    }

    private function prepareStat(int $currentMonthCount, int $previousMonthCount, Stat $stat): Stat
    {
        // Вычисление прироста или убывания
        $difference = $currentMonthCount - $previousMonthCount;
        $trendingIcon = $difference >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $trendingDescription = ($difference >= 0 ? 'Увеличение на ' : 'Падение на ') . $difference . ' позиции';

        return $stat->description($trendingDescription)
            ->descriptionIcon($trendingIcon)
            ->chart([$previousMonthCount, $currentMonthCount]) // График может отображать текущий и предыдущий месяцы
            ->color($difference >= 0 ? 'success' : 'danger');
    }

    private function getPostalItemStat(): Stat
    {
        $query = Order::query();
        $currentMonthCount = $this->getMonthlyCount($query);
        $previousMonthCount = $this->getMonthlyCount($query, Carbon::now()->subMonth());

        return $this->prepareStat($currentMonthCount, $previousMonthCount, Stat::make('Статистика Заказов за текущий месяц', self::getFormat($currentMonthCount)));
    }
}
