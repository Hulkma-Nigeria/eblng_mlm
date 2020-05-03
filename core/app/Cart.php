<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = ['id'];
    public function cartItems () {
        return $this->hasMany(CartItem::class);
    }
    public function user () {
        return $this->belongsTo(User::class);
    }
}
