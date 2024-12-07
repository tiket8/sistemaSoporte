@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Subcategorías</h1>
    <a href="{{ route('subcategoria.create') }}" class="btn btn-primary mb-3">Nueva Subcategoría</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategorias as $subcategoria)
            <tr>
                <td>{{ $subcategoria->subcat_id }}</td>
                <td>{{ $subcategoria->subcat_nom }}</td>
                <td>{{ $subcategoria->categoria->cat_nom ?? 'Sin Categoría' }}</td>
                <td>
                    @if ($subcategoria->estatus)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-danger">Inactivo</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('subcategoria.edit', $subcategoria->subcat_id) }}" class="btn btn-warning">Editar</a>
                    @if ($subcategoria->estatus)
                        <form action="{{ route('subcategoria.destroy', $subcategoria->subcat_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('¿Estás seguro de desactivar esta subcategoría?')">Desactivar</button>
                        </form>
                    @else
                        <form action="{{ route('subcategoria.restore', $subcategoria->subcat_id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button class="btn btn-success" onclick="return confirm('¿Estás seguro de activar esta subcategoría?')">Activar</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
