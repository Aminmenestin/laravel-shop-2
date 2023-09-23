<?php

namespace App\Models;

use App\Models\OrderItems;
use App\Models\Transactions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = [];


    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value ? 'پرداخت شده' : "پرداخت نشده",
        );
    }



    public function orderItems(){
        return $this->hasMany(OrderItems::class);
    }


    public function transaction(){
        return $this->hasOne(Transactions::class);
    }

}
