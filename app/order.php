<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //

    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }
}
