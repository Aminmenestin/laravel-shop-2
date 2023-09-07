<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model
{
    use HasFactory;

    protected $table = 'product_variations';
    protected $guarded = [];
    protected $appends = ['percent_count'];


    // public function percentCounter(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => $this->price
    //     );
    // }

    public function getPercentCountAttribute(){
        return $this;
    }
}
