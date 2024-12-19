@extends('layouts.app')

@section('title', 'Detalle Ticket')

@section('content')
<div class="container">
    <h3>Detalle Ticket - {{ $ticket->tick_id }}</h3>
    <p>Estado: 
        <span class="badge {{ $ticket->tick_estado === 'abierto' ? 'bg-success' : 'bg-danger' }}">
            {{ ucfirst($ticket->tick_estado) }}
        </span>
    </p>
    <p>Usuario: {{ $ticket->usuario->name ?? 'Usuario desconocido' }}</p>
    <p>Fecha de creación: {{ $ticket->created_at->format('d/m/Y H:i') }}</p>

    <h4>Detalles</h4>
    <p><strong>Título:</strong> {{ $ticket->tick_titulo }}</p>
    <p><strong>Categoría:</strong> {{ $ticket->categoria->cat_nom ?? 'N/A' }}</p>
    <p><strong>Subcategoría:</strong> {{ $ticket->subcategoria->subcat_nom ?? 'N/A' }}</p>
    <p><strong>Prioridad:</strong> {{ $ticket->prioridad->prio_nom ?? 'N/A' }}</p>
    <p><strong>Descripción:</strong> {{ $ticket->tick_descrip }}</p>

    <h4>Documentos</h4>
    @if ($ticket->documentos->isEmpty())
        <p>No hay documentos asociados.</p>
    @else
        <ul>
            @foreach ($ticket->documentos as $documento)
                <li>
                    <a href="{{ asset('storage/' . $documento->ruta) }}" target="_blank">{{ $documento->doc_nom }}</a>
                </li>
            @endforeach
        </ul>
    @endif

    <h4>Agregar un comentario</h4>
    <form method="POST" action="{{ route('tickets.update', $ticket->tick_id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <textarea name="comentario" class="form-control" placeholder="Añade un comentario..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
