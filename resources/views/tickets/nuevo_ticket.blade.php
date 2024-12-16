@extends('layouts.app')

@section('title', 'Nuevo Ticket')

@section('content')
<div class="container">
    <h3>Nuevo Ticket</h3>
    <p>
        Desde esta ventana podrá generar nuevos tickets de soporte.<br>
        (*) Datos Obligatorios.
    </p>

    <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Título -->
        <div class="mb-3">
            <label for="tick_titulo" class="form-label">Título (*)</label>
            <input type="text" class="form-control @error('tick_titulo') is-invalid @enderror" id="tick_titulo" name="tick_titulo" placeholder="Ingresa un título que describa tu problema" value="{{ old('tick_titulo') }}" required>
            @error('tick_titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Categoría -->
        <div class="mb-3">
            <label for="cat_id" class="form-label">Categoría (*)</label>
            <select id="cat_id" name="cat_id" class="form-select @error('cat_id') is-invalid @enderror" required>
                <option value="">Seleccionar</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->cat_id }}" {{ old('cat_id') == $categoria->cat_id ? 'selected' : '' }}>
                        {{ $categoria->cat_nom }}
                    </option>
                @endforeach
            </select>
            @error('cat_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Subcategoría -->
        <div class="mb-3">
            <label for="cats_id" class="form-label">SubCategoría (*)</label>
            <select id="cats_id" name="cats_id" class="form-select @error('cats_id') is-invalid @enderror">
                <option value="">Seleccionar</option>
                <!-- Las subcategorías se cargarán dinámicamente -->
            </select>
            @error('cats_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Prioridad -->
        <div class="mb-3">
            <label for="prio_id" class="form-label">Prioridad (*)</label>
            <select id="prio_id" name="prio_id" class="form-select @error('prio_id') is-invalid @enderror" required>
                <option value="">Seleccionar</option>
                @foreach ($prioridades as $prioridad)
                    <option value="{{ $prioridad->prio_id }}" {{ old('prio_id') == $prioridad->prio_id ? 'selected' : '' }}>
                        {{ $prioridad->prio_nom }}
                    </option>
                @endforeach
            </select>
            @error('prio_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Documentos -->
        <div class="mb-3">
            <label for="files" class="form-label">Documentos Adicionales</label>
            <input type="file" name="files[]" id="files" class="form-control @error('files.*') is-invalid @enderror" multiple>
            @error('files.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Descripción -->
        <div class="mb-3">
            <label for="tick_descrip" class="form-label">Descripción (*)</label>
            <textarea id="tick_descrip" name="tick_descrip" class="form-control @error('tick_descrip') is-invalid @enderror" placeholder="Describe con tus palabras la problemática o necesidad de tu solicitud" required>{{ old('tick_descrip') }}</textarea>
            @error('tick_descrip')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botón Guardar -->
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('cat_id').addEventListener('change', function () {
        const categoriaId = this.value;

        // Limpia el select de subcategorías
        const subcategoriaSelect = document.getElementById('cats_id');
        subcategoriaSelect.innerHTML = '<option value="">Seleccionar</option>';

        if (categoriaId) {
            // Realiza la solicitud AJAX para obtener las subcategorías
            fetch(`/api/subcategorias/${categoriaId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategoria => {
                        const option = document.createElement('option');
                        option.value = subcategoria.subcat_id;
                        option.textContent = subcategoria.subcat_nom;
                        subcategoriaSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar subcategorías:', error));
        }
    });
</script>
@endsection
