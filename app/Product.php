<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    //
    protected $fillable = [
       'user_id', 'product_name', 'service', 'product_category', 'description', 'quantity', 
        'amount', 'file_path', 'category_id',
    ];

    protected $table = "products";

    public function category()
    {
        return $this->hasMany(category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'id', 'product_id');
    
    }
}
