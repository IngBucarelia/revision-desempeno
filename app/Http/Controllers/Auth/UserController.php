<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index'); // Asegúrate de tener esta vista en resources/views/user/index.blade.php
    }
}
