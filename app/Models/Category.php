<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute as AttributeModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = [];



    protected function isActive(): Attribute
     {
        return Attribute::make(
            get: fn (string $value) => $value ? 'فعال' : 'غیر فعال',
        );
    }



    public function attributes(){
        return $this->belongsToMany(AttributeModel::class , 'attribute_category');
    }


    public function parent(){
        return $this->belongsTo(Category::class , 'parent_id')->where('is_active' , 1);
    }


    public function children(){
        return $this->hasMany(Category::class , 'parent_id')->where('is_active' , 1);
    }

}
