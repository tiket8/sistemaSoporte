@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Ticket</h1>
    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="tick_titulo">Título</label>
            <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" required>
        </div>
        <div class="form-group">
            <label for="tick_descrip">Descripción</label>
            <textarea class="form-control" id="tick_descrip" name="tick_descrip" required></textarea>
        </div>
        <div class="form-group">
            <label for="cat_id">Categoría</label>
            <select id="cat_id" name="cat_id" class="form-control" required>
                <option value="">Seleccionar</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cats_id">Subcategoría</label>
            <select id="cats_id" name="cats_id" class="form-control">
                <option value="">Seleccionar</option>
                @foreach($subcategorias as $subcategoria)
                    <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fileElem">Archivos Adjuntos</label>
            <input type="file" id="fileElem" name="fileElem[]" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection
