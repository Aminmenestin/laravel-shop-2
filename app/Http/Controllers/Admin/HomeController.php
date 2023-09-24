<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transactions;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
}
