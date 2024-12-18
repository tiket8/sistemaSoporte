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
                    <td>{{ $ticket->tick_id }}</td>
                    <td>{{ $ticket->tick_titulo }}</td>
                    <td>{{ $ticket->categoria->cat_nom ?? 'Sin categoría' }}</td>
                    <td>{{ $ticket->tick_estado }}</td>
                    <td>{{ $ticket->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->tick_id) }}" class="btn btn-primary">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
