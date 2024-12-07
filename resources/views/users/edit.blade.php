@extends('layouts.app')

@section('content')
<div class="container">
    <header class="section-header">
        <h3>Editar Usuario</h3>
    </header>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="rol">Rol</label>
            <select name="rol" id="rol" class="form-control">
                <option value="admin" {{ $user->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="soporte" {{ $user->rol == 'soporte' ? 'selected' : '' }}>Soporte</option>
                <option value="cliente" {{ $user->rol == 'cliente' ? 'selected' : '' }}>Cliente</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
