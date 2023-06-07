<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    use HasFactory;

    protected $table = "order_product";

    public static function boot()
    {
        parent::boot();

        static::created(function ($item) {
            dd($item);
        });

        static::deleted(function ($item) {
            dd($item);
        });
    }
}
