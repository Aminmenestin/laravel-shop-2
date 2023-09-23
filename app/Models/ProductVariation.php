<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute as AttributeModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model
{
    use HasFactory;

    protected $table = 'product_variations';
    protected $guarded = [];

    protected $appends = ['percent_sale'];

    public function PercentSale():Attribute
    {
        return Attribute::make(
            get: fn () => $this->is_sale ? round((($this->price - $this->sale_price) / $this->price) * 100)  : 'no',
        );
    }
    public function ProductQuantity():Attribute
    {
        return Attribute::make(
            get: fn () => $this->quantity
        );
    }


    public function attribute(){
        return $this->belongsTo(AttributeModel::class);
    }


}
