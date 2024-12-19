<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    // Переопределим метод afterSave
    protected function afterSave(): void
    {
        // Перенаправляем на страницу всех заказов после сохранения
        $this->redirect(OrderResource::getUrl('index'));
    }
}
