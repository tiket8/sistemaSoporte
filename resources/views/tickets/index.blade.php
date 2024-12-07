@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tickets</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->tick_titulo }}</td>
                    <td>{{ $ticket->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td>{{ $ticket->tick_estado }}</td>
                    <td>{{ $ticket->fech_crea }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-primary">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
