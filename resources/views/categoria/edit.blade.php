@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Categoría</h1>
    <form action="{{ route('categoria.update', $categoria->cat_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cat_nom">Nombre</label>
            <input type="text" class="form-control" id="cat_nom" name="nombre" value="{{ $categoria->cat_nom }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
