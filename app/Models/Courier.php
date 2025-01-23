<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Courier extends Model
{
    protected $fillable =['surname', 'name', 'patronymic'];

    public function delivery(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }
}
