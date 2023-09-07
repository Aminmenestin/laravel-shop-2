<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Category;
use App\Models\ProductRate;
use App\Models\ProductImages;
use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory , Sluggable;


    protected $table = 'products';
    protected $guarded = [];

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value ? 'فعال' : 'غیر فعال',
        );
    }

    public function scopeFilter($query)
    {
        if (request()->has('attribute')) {

            foreach (request()->attribute as $attribute) {
                $query->whereHas('attributes', function ($query) use ($attribute) {
                    foreach (explode('-', $attribute) as $index => $item) {
                        if ($index == 0) {
                            $query->where('value', $item);
                        } else {
                            $query->orWhere('value', $item);
                        }
                    }
                });
            }
        }



        if (request()->has('variation')) {

            $query->whereHas('variations', function ($query) {
                foreach (explode('-', request()->variation) as $index => $variation) {
                    if ($index == 0) {
                        $query->where('value', $variation);
                    } else {
                        $query->orWhere('value', $variation);
                    }
                }
            });
        }


        if (request()->has('sortBy')) {

            $sortBy = request()->sortBy;

            switch ($sortBy) {
                case 'Max':
                    $query->orderByDesc(ProductVariation::select('price')->whereColumn('product_variations.product_id', 'products.id')->orderBy('sale_price', 'desc')->take(1));
                    break;
                case 'Min':
                    $query->orderBy(ProductVariation::select('price')->whereColumn('product_variations.product_id', 'products.id')->orderBy('sale_price', 'asc')->take(1));
                    break;
                case 'Latest':
                    $query->latest();
                    break;
                case 'Oldest':
                    $query->oldest();
                    break;
                default:
                    $query;
                    break;
            }
        }


        return $query;
    }

    public function scopeSearch($query)
    {

        $keyWord = request()->search;

        if (request()->has('search') && trim($keyWord) != '') {
            $query->where('name', 'LIKE', '%' . trim($keyWord) . '%');
        }

        return $query;
    }


    public function quantityCheck(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->variations()->where('quantity', '>', 0)->first() ?? null,
        );
    }
    public function isSaleCheck(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->variations()->where('quantity', '>', 0)->where('sale_price', '!=', null)->where('date_on_sale_from', '<', Carbon::now())->where('date_on_sale_to', '>', Carbon::now())->orderBy('sale_price')->first() ?? false,
        );
    }

    public function priceCheck(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->variations()->where('quantity', '>', 0)->orderBy('price')->first() ?? false,
        );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }


    public function rates()
    {
        return $this->hasMany(ProductRate::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('approved' , 1);
    }
}
