@extends('layouts.app')

@section('title', 'Consultar Tickets')

@section('content')
<div class="container">
    <h3>Consultar Tickets</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nro. Ticket</th>
                <th>Categoría</th>
                <th>Título</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Fecha Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->categoria->nombre }}</td>
                    <td>{{ $ticket->tick_titulo }}</td>
                    <td>{{ $ticket->prioridad->nombre }}</td>
                    <td>
                        <span class="badge {{ $ticket->tick_estado === 'Abierto' ? 'bg-success' : 'bg-danger' }}">
                            {{ $ticket->tick_estado }}
                        </span>
                    </td>
                    <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-primary">Ver</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay tickets disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
