<?php

namespace App\Shop\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'customer_id', 'evaluat', 'comment'];
    
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}