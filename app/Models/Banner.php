<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;


    protected $table = 'banner';
    protected $guarded = [];


    protected function isActive(): Attribute
    {
        return Attribute::make(
            fn ($value) => $value == 1 ? 'فعال' : 'غیر فعال',
        );
    }

}
