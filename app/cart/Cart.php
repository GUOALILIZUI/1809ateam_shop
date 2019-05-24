<?php

namespace App\cart;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public $table ='shop_cart';
    public $primaryKey = 'cart_id';
    public $timestamps = false;
}
