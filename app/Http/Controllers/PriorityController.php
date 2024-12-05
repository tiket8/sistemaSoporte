<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function index()
    {
        return view('priorities.index'); // Crea una vista en resources/views/priorities/index.blade.php
    }
}
