<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;


    protected $table = 'attributes';
    protected $guarded = [];


    public function categories(){
        return $this->belongsToMany(Category::class , 'attribute_category');
    }


    public function attribiuteValue(){
        return $this->hasMany(ProductAttribute::class , 'attribute_id')->select('attribute_id' , 'value')->distinct();
    }
    public function variationValue(){
        return $this->hasMany(ProductVariation::class , 'attribute_id')->select('attribute_id' , 'value')->distinct();
    }

}
