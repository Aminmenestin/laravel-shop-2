<?php

namespace App\Models;

use App\Models\User;
use App\Models\Provinces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';

    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
