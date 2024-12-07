@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Subcategoría</h1>
    <form action="{{ route('subcategoria.update', $subcategoria->subcat_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="subcat_nom">Nombre</label>
            <input type="text" class="form-control" id="subcat_nom" name="subcat_nom" value="{{ $subcategoria->subcat_nom }}" required>
        </div>
        <div class="form-group">
            <label for="cat_id">Categoría</label>
            <select class="form-control" id="cat_id" name="cat_id" required>
                <option value="">Seleccionar Categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->cat_id }}" {{ $subcategoria->cat_id == $categoria->cat_id ? 'selected' : '' }}>
                        {{ $categoria->cat_nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
