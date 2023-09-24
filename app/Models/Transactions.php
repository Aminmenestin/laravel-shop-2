<?php

namespace App\Models;

use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $guarded = [];


    public function scopeGetData($query , $month , $status){

        $v = verta()->startMonth()->subMonths($month - 1);
        $date = Verta::jalaliToGregorian($v->year ,$v->month , $v->day );
        return $query->where('created_at' , '>' , Carbon::create($date[0] , $date[1] , $date[2]))->where('status' , $status)->get();

    }
}
