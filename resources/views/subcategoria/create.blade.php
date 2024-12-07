@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Subcategoría</h1>
    <form action="{{ route('subcategoria.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subcat_nom">Nombre</label>
            <input type="text" class="form-control" id="subcat_nom" name="subcat_nom" required>
        </div>
        <div class="form-group">
            <label for="cat_id">Categoría</label>
            <select class="form-control" id="cat_id" name="cat_id" required>
                <option value="">Seleccionar Categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->cat_id }}">{{ $categoria->cat_nom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
