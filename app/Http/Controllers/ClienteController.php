<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Muestra el dashboard de cliente.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('cliente.dashboard'); // Asumiendo que tienes una vista llamada 'cliente/dashboard.blade.php'
    }
}
