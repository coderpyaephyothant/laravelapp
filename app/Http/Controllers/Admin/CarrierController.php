<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarrierController extends Controller
{
    public function carrier(){
        return view('admin.carrier.delivery');
    }
}
