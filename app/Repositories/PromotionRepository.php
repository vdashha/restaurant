<?php

namespace App\Repositories;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PromotionRepository extends BaseRepository
{
    public function __construct()
    {
        static::setModel(Promotion::class);
    }

    public function getByActualDate()
    {
        return $this->model::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();
    }

}
