<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'customer_id',
        'pizza_id',
        'delivery_id',
        'order_time',
        'payment_status',
    ];
}
