<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'price', 'image'];

    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }
      public function orders(){
        return $this->hasMany(Order::class);
    }
}
