<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function viewRegister()
    {
        return view('admin.auth.register');
    }
}
