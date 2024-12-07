@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Categorías</h1>
    <a href="{{ route('categoria.create') }}" class="btn btn-primary mb-3">Nueva Categoría</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->cat_id }}</td>
                <td>{{ $categoria->cat_nom }}</td>
                <td>
                    @if ($categoria->estatus)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-danger">Inactivo</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('categoria.edit', $categoria->cat_id) }}" class="btn btn-warning">Editar</a>
                    @if ($categoria->estatus)
                        <form action="{{ route('categoria.destroy', $categoria->cat_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('¿Estás seguro de desactivar esta categoría?')">Desactivar</button>
                        </form>
                    @else
                        <form action="{{ route('categoria.restore', $categoria->cat_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn btn-success" onclick="return confirm('¿Estás seguro de activar esta categoría?')">Activar</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
