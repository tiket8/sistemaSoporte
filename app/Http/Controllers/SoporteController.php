<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoporteController extends Controller
{
    /**
     * Muestra el dashboard de soporte.
     */
    public function index()
    {
        return view('soporte.dashboard'); 
    }
}
