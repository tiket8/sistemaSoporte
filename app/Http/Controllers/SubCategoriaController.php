<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    public function index()
{
    $subcategorias = Subcategoria::with('categoria')->get(); // Relación con categorías
    $categorias = Categoria::all(); // Para el select del modal
    return view('subcategoria.index', compact('subcategorias', 'categorias'));
}

    public function create()
    {
        // Obtiene todas las categorías para el formulario
        $categorias = Categoria::all();

        return view('subcategoria.create', compact('categorias')); // Vista de creación
    }

    public function store(Request $request)
{
    // Validación de los datos del formulario
    $request->validate([
        'subcat_nom' => 'required|string|max:255', // Nombre de la subcategoría es requerido
        'cat_id' => 'required|exists:categorias,cat_id', // La categoría debe existir en la tabla
    ]);

    // Crear la subcategoría
    Subcategoria::create([
        'subcat_nom' => $request->subcat_nom,
        'cat_id' => $request->cat_id,
        'estatus' => 1, // Activo por defecto
    ]);

    return redirect()->route('subcategoria.index')->with('success', 'Subcategoría creada correctamente.');
}

    public function edit($id)
    {
        // Encuentra la subcategoría por su ID
        $subcategoria = Subcategoria::findOrFail($id);

        // Obtiene todas las categorías para mostrarlas en el formulario
        $categorias = Categoria::all();

        return view('subcategoria.edit', compact('subcategoria', 'categorias')); // Vista de edición
    }

    public function update(Request $request, $id)
    {
        // Valida los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255', // Validación para el nombre de la subcategoría
            'cat_id' => 'required|exists:categorias,cat_id', // Validación para la relación con la tabla categorías
        ]);

        // Encuentra y actualiza la subcategoría
        $subcategoria = Subcategoria::findOrFail($id);
        $subcategoria->update([
            'subcat_nom' => $request->nombre,
            'cat_id' => $request->cat_id,
        ]);

        // Redirige al listado con un mensaje de éxito
        return redirect()->route('subcategoria.index')->with('success', 'Subcategoría actualizada correctamente.');
    }

    public function destroy($id)
{
    $subcategoria = Subcategoria::findOrFail($id);
    $subcategoria->update(['estatus' => false]); // Cambiar estatus a "inactivo"

    return redirect()->route('subcategoria.index')->with('success', 'Subcategoría desactivada correctamente.');
}

public function restore($id)
{
    $subcategoria = Subcategoria::withTrashed()->findOrFail($id);
    $subcategoria->update(['estatus' => true]); // Reactivar
    return redirect()->route('subcategoria.index')->with('success', 'Subcategoría activada correctamente.');
}

}
