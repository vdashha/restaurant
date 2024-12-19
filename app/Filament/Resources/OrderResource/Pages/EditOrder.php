<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    // Переопределим метод afterSave
    protected function afterSave(): void
    {
        // Перенаправляем на страницу всех заказов после сохранения
        $this->redirect(OrderResource::getUrl('index'));

    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
