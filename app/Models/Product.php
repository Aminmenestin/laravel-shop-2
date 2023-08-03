<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImages;
use Spatie\Sluggable\HasSlug;
use App\Models\ProductAttribute;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory , HasSlug;


    protected $table = 'products';
    protected $guarded = [];

    protected function isActive(): Attribute
    {
       return Attribute::make(
           get: fn (string $value) => $value ? 'فعال' : 'غیر فعال',
       );
   }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    public function tags(){
        return $this->belongsToMany(Tag::class , 'product_tag');
    }


    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(ProductImages::class);
    }

    public function attributes(){
        return $this->hasMany(ProductAttribute::class);
    }

    public function variations(){
        return $this->hasMany(ProductVariation::class);
    }


}
