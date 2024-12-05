<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        // Retorna la vista de listado de subcategorías
        return view('subcategories.index'); // Crea la vista en resources/views/subcategories/index.blade.php
    }

    public function create()
    {
        // Retorna la vista para crear una nueva subcategoría
        return view('subcategories.create'); // Crea la vista en resources/views/subcategories/create.blade.php
    }

    public function store(Request $request)
    {
        // Lógica para guardar una nueva subcategoría
    }

    public function edit($id)
    {
        // Retorna la vista para editar una subcategoría
        return view('subcategories.edit', compact('id')); // Crea la vista en resources/views/subcategories/edit.blade.php
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar una subcategoría existente
    }

    public function destroy($id)
    {
        // Lógica para eliminar una subcategoría
    }
}
