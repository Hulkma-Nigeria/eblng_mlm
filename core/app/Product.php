<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['sku', 'name', 'description', 'stock', 'stock_alert', 'price', 'status', 'point_value', 'images'];
}
