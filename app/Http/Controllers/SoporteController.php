<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoporteController extends Controller
{
    /**
     * Muestra el dashboard de soporte.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('soporte.dashboard'); // Asumiendo que tienes una vista llamada 'soporte/dashboard.blade.php'
    }
}
