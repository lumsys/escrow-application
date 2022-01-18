<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class buyer extends Model
{

    use SoftDeletes;
    //
    protected $dates = ['deleted_at'];

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
        return $this->belongsTo(user::class, 'user_id', 'id');
     
     }
 
    
}
