<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceControlller extends Controller
{
    //
    public function index(){
        return view ('landing/service/index');
    }

}
