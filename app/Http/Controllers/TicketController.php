<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Documento;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Prioridad;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Muestra los tickets del usuario autenticado según su rol
    public function index()
    {
        $user = Auth::user();

        if ($user->rol === 'admin') {
            $tickets = Ticket::with(['usuario', 'categoria', 'subcategoria', 'prioridad'])->get();
        } elseif ($user->rol === 'soporte') {
            // Soporte ve tickets asignados o todos, según la lógica de negocio
            $tickets = Ticket::with(['usuario', 'categoria', 'subcategoria', 'prioridad'])
                ->where('assigned_to', $user->id) // Ajusta esto según el campo que indique asignación
                ->get();
        } else {
            // Cliente solo ve sus propios tickets
            $tickets = Ticket::with(['usuario', 'categoria', 'subcategoria', 'prioridad'])
                ->where('usu_id', $user->id)
                ->get();
        }

        return view('tickets.index', compact('tickets'));
    }

    // Muestra el formulario para crear un nuevo ticket
    public function create()
{
    // Obtener categorías activas
    $categorias = Categoria::where('estatus', true)->get(['cat_id', 'cat_nom']);

    // Obtener subcategorías activas
    $subcategorias = Subcategoria::where('estatus', true)->get(['subcat_id', 'subcat_nom']);

    // Obtener prioridades activas
    $prioridades = Prioridad::where('est', 1)->get(['prio_id', 'prio_nom']);

    return view('tickets.nuevo_ticket', compact('categorias', 'subcategorias', 'prioridades'));
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

        // Redirigir según el rol del usuario
        $roleRoute = Auth::user()->rol === 'soporte' ? 'soporte.tickets.index' : 'cliente.tickets.index';

        return redirect()->route($roleRoute)->with('success', 'Ticket creado exitosamente.');
    }

    // Muestra el detalle de un ticket
    public function show(Ticket $ticket)
    {
        // Validar que el usuario tenga acceso al ticket
        $user = Auth::user();
        if ($user->rol === 'cliente' && $ticket->usu_id !== $user->id) {
            abort(403, 'No tienes permiso para ver este ticket.');
        }

        if ($user->rol === 'soporte' && $ticket->assigned_to !== $user->id) {
            abort(403, 'No tienes permiso para ver este ticket.');
        }

        $documentos = $ticket->documentos;
        return view('tickets.detalle_ticket', compact('ticket', 'documentos'));
    }

    // Actualiza el estado de un ticket (cerrar o reabrir)
    public function update(Request $request, Ticket $ticket)
    {
        $validatedData = $request->validate([
            'tick_estado' => 'required|in:Abierto,Cerrado',
        ]);

        $ticket->update(['tick_estado' => $validatedData['tick_estado']]);

        // Redirigir según el rol del usuario
        $roleRoute = Auth::user()->rol === 'soporte' ? 'soporte.tickets.index' : 'cliente.tickets.index';

        return redirect()->route($roleRoute)->with('success', 'Estado del ticket actualizado.');
    }
}
