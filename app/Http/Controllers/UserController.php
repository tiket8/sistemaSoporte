<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index'); // Asegúrate de tener una vista llamada 'index.blade.php' en 'resources/views/users'
    }
}
