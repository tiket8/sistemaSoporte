<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Documento;
use App\Models\Usuario;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Prioridad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    // Muestra todos los tickets
    public function index()
    {
        // Recuperar tickets del usuario autenticado
        $tickets = Auth::user()->rol === 'admin' 
            ? Ticket::with(['usuario', 'categoria', 'subcategoria', 'prioridad'])->get()
            : Ticket::with(['usuario', 'categoria', 'subcategoria', 'prioridad'])
                ->where('usu_id', Auth::id())
                ->get();

        return view('tickets.index', compact('tickets'));
    }

    // Muestra el formulario para crear un ticket
    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $prioridades = Prioridad::all();

        return view('tickets.create', compact('categorias', 'subcategorias', 'prioridades'));
    }

    // Guarda un nuevo ticket
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tick_titulo' => 'required|string|max:255',
            'tick_descrip' => 'required|string',
            'cat_id' => 'required|exists:categorias,id',
            'cats_id' => 'nullable|exists:subcategorias,id',
            'prio_id' => 'required|exists:prioridades,id',
            'files.*' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $ticket = Ticket::create([
            'usu_id' => Auth::id(),
            'cat_id' => $validatedData['cat_id'],
            'cats_id' => $validatedData['cats_id'] ?? null,
            'tick_titulo' => $validatedData['tick_titulo'],
            'tick_descrip' => $validatedData['tick_descrip'],
            'prio_id' => $validatedData['prio_id'],
            'tick_estado' => 'Abierto',
        ]);

        // Manejo de archivos adjuntos
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store("tickets/{$ticket->id}/documentos", 'public');
                Documento::create([
                    'tick_id' => $ticket->id,
                    'nombre' => $file->getClientOriginalName(),
                    'ruta' => $path,
                ]);
            }
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket creado exitosamente.');
    }

    // Muestra el detalle de un ticket
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $documentos = $ticket->documentos;
        return view('tickets.show', compact('ticket', 'documentos'));
    }

    // Actualiza el estado de un ticket (cerrar, reabrir, asignar)
    public function update(Request $request, Ticket $ticket)
    {
        $validatedData = $request->validate([
            'tick_estado' => 'required|in:Abierto,Cerrado',
        ]);

        $ticket->update(['tick_estado' => $validatedData['tick_estado']]);

        return redirect()->route('tickets.index')->with('success', 'Estado del ticket actualizado.');
    }
}
