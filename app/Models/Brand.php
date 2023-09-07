<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory , Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $table = 'brands';
    protected $guarded = [];


    protected function isActive(): Attribute
    {
        return Attribute::make(
            fn ($value) => $value == 1 ? 'فعال' : 'غیر فعال',
        );
    }
}
