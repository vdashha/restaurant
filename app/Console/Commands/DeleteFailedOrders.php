<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteFailedOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-failed-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete failed orders';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        OrderItem::whereIn('order_id', function ($query) {
                $query->select('id')
                    ->from('orders')
                    ->where('status', 'failed');
            })->delete();

        Order::where('status', 'failed')
            ->delete();
    }
}
