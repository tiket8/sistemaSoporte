<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prioridad;

class PrioridadController extends Controller
{
    /**
     * Mostrar la lista de prioridades activas.
     */
    public function index()
    {
        $prioridades = Prioridad::where('est', 1)->get();
        return view('prioridad.index', compact('prioridades'));
    }

    /**
     * Guardar o actualizar una prioridad.
     */
    public function store(Request $request)
    {

        $prio_id = $request->input('prio_id', null);
        
        $request->validate([
            'prio_nom' => 'required|string|max:255|unique:tm_prioridad,prio_nom,' . ($request->prio_id ?? 'NULL') . ',prio_id',
        ]);

        // Crear o actualizar prioridad
        Prioridad::updateOrCreate(
            ['prio_id' => $request->prio_id], // Buscar por prio_id
            ['prio_nom' => $request->prio_nom, 'est' => 1] // Datos a actualizar/guardar
        );

        return redirect()->route('prioridad.index')->with('success', 'La prioridad se ha guardado correctamente.');
    }

    /**
     * Cambiar el estado de una prioridad a "inactivo" (eliminar lógica).
     */
    public function destroy($id)
    {
        $prioridad = Prioridad::findOrFail($id);
        $prioridad->update(['est' => 0]);

        return redirect()->route('prioridad.index')->with('success', 'La prioridad se ha eliminado correctamente.');
    }

    /**
     * Obtener los datos de una prioridad para edición.
     */
    public function edit($id)
    {
        $prioridad = Prioridad::findOrFail($id);
        return response()->json($prioridad);
    }
}
