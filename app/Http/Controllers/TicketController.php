<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        // Retorna la vista del listado de tickets
        return view('tickets.index'); // Crea la vista en resources/views/tickets/index.blade.php
    }

    public function create()
    {
        // Retorna la vista para crear un nuevo ticket
        return view('tickets.create'); // Crea la vista en resources/views/tickets/create.blade.php
    }

    public function store(Request $request)
    {
        // Lógica para guardar un nuevo ticket
    }

    public function edit($id)
    {
        // Retorna la vista para editar un ticket
        return view('tickets.edit', compact('id')); // Crea la vista en resources/views/tickets/edit.blade.php
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar un ticket existente
    }

    public function destroy($id)
    {
        // Lógica para eliminar un ticket
    }
}
