<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductRate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $guarded = [];

    public function Approved():Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value ? 'فعال' : 'غیر فعال',
        );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function rate(){
        return $this->hasOne(ProductRate::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

}
