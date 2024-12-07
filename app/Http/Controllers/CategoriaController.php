<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        // Obtiene todas las categorías junto con sus subcategorías relacionadas
        $categorias = Categoria::with('subcategorias')->get();
    return view('categoria.index', compact('categorias')); // Vista para listar categorías
    }

    public function create()
    {
        // Muestra la vista para crear una nueva categoría
        return view('categoria.create'); // Vista de creación
    }

    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255', // Usa el campo "nombre" como está en el formulario
        ]);

        // Crea una nueva categoría
        Categoria::create([
            'cat_nom' => $request->nombre, // Mapea "nombre" al campo "cat_nom" en la base de datos
        ]);

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('categoria.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit($id)
    {
        // Encuentra la categoría por su ID
        $categoria = Categoria::findOrFail($id);

        // Muestra la vista de edición
        return view('categoria.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        // Valida los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255', // Usa "nombre" para el formulario
        ]);

        // Encuentra y actualiza la categoría
        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'cat_nom' => $request->nombre, // Mapea "nombre" al campo "cat_nom"
        ]);

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('categoria.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy($id)
{
    $categoria = Categoria::findOrFail($id);
    $categoria->update(['estatus' => false]); 

    return redirect()->route('categoria.index')->with('success', 'Categoría desactivada correctamente.');
}

public function restore($id)
{
    // Encuentra la categoría (incluso si está desactivada)
    $categoria = Categoria::findOrFail($id);

    // Actualiza el estatus de la categoría a "activa"
    $categoria->update(['estatus' => true]);

    // Redirige al listado con un mensaje de éxito
    return redirect()->route('categoria.index')->with('success', 'Categoría activada correctamente.');
}

}
