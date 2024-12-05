<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Retorna la vista de listado de categorías
        return view('categories.index'); // Crea la vista en resources/views/categories/index.blade.php
    }

    public function create()
    {
        // Retorna la vista para crear una nueva categoría
        return view('categories.create'); // Crea la vista en resources/views/categories/create.blade.php
    }

    public function store(Request $request)
    {
        // Lógica para guardar una nueva categoría
    }

    public function edit($id)
    {
        // Retorna la vista para editar una categoría
        return view('categories.edit', compact('id')); // Crea la vista en resources/views/categories/edit.blade.php
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar una categoría existente
    }

    public function destroy($id)
    {
        // Lógica para eliminar una categoría
    }
}
