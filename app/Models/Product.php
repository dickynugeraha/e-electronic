<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "price",
        "type",
        "description",
        "product_photo",
        "is_available",
    ];

    public function cart()
    {
        return $this->belongsToMany(Cart::class)
            ->withPivot(["quantity", "price_per_item", "description"])
            ->withTimestamps();
    }
}
