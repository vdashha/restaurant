<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'dish_id', 'quantity'];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}

