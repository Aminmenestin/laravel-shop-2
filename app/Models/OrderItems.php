<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItems extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $guarded = [];


    public function product(){
        return $this->belongsTo(Product::class);
    }
}