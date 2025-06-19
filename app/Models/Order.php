<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'customer_name',
    'order_date',
    'status',
    'comment',
    'product_id',
    'quantity',
];

public function product()
{
    return $this->belongsTo(\App\Models\Product::class);
}

}
