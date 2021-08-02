<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //

    public function products()
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }
}
