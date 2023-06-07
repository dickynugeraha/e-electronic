<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartProduct extends Pivot
{
    use HasFactory;

    protected $table = "cart_product";

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
