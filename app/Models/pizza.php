<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pizza extends Model
{
    use HasFactory;
    protected $fillable = [
        'pizza_id',
        'pizza_name',
        'image',
        'price',
        'discount_percentage',
        'publish_status',
        'discount_price',
        'category_id',
        'type',
        'buy_one_get_one',
        'waiting_time',
        'description',

    ];
}
