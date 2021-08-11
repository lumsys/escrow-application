<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class buyer extends Model
{
    //
    protected $fillable = [
        'user_id', 'product_name', 'service', 'product_category', 'description', 'quantity', 
         'amount', 'file_path', 'category_id',
     ];
 
     protected $table = "buyers";
    
     public function category()
     {
         return $this->hasMany(category::class, 'category_id', 'id');
     }
 
     public function user()
     {
        return $this->belongsTo(user::class);
     
     }
 
     public function order()
     {
         return $this->hasMany(Order::class, 'id', 'product_id');
     
     }
 
    
}
