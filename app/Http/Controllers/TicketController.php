<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Categoria; 
use App\Models\Subcategoria; 

class TicketController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo ticket.
     */
    public function create()
    {
        $categorias = Categoria::all(); // Ajuste para usar el modelo correcto
        $subcategorias = Subcategoria::all(); // Ajuste para usar el modelo correcto

        return view('tickets.create', compact('categorias', 'subcategorias'));
    }

    /**
     * Almacena un nuevo ticket en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tick_titulo' => 'required|string|max:255',
            'tick_descrip' => 'required|string',
            'cat_id' => 'required|exists:categorias,id', // Ajuste para reflejar la tabla correcta
            'cats_id' => 'nullable|exists:subcategorias,id', // Ajuste para reflejar la tabla correcta
            'prio_id' => 'required|exists:prioridades,id', // Ajuste para reflejar la tabla correcta
            'fileElem.*' => 'nullable|file|max:2048',
        ]);

        // Crear el ticket
        $ticket = Ticket::create([
            'usu_id' => Auth::id(),
            'cat_id' => $request->cat_id,
            'cats_id' => $request->cats_id,
            'tick_titulo' => $request->tick_titulo,
            'tick_descrip' => $request->tick_descrip,
            'tick_estado' => 'Abierto',
            'fech_crea' => now(),
            'prio_id' => $request->prio_id,
            'est' => 1,
        ]);

        // Manejar archivos adjuntos
        if ($request->hasFile('fileElem')) {
            foreach ($request->file('fileElem') as $file) {
                $path = $file->store("tickets/{$ticket->id}", 'public'); // Almacenar en almacenamiento público
                $ticket->documentos()->create([
                    'nombre' => $file->getClientOriginalName(),
                    'ruta' => $path,
                ]);
            }
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket creado exitosamente.');
    }

    /**
     * Lista todos los tickets.
     */
    public function index()
    {
        $tickets = Ticket::with(['usuario', 'categoria', 'subcategoria'])->get();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Muestra los detalles de un ticket específico.
     */
    public function show($id)
    {
        $ticket = Ticket::with(['usuario', 'categoria', 'subcategoria', 'documentos'])->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }
}
