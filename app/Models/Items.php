<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [
        'name',
        'status',
        'price',
        'description',
        'stock_quantity',
        'tax_rate',
        'category_id',
        'unit'
    ];
    //
}
