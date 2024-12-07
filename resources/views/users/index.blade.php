@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <header class="section-header">
        <div class="tbl">
            <div class="tbl-row">
                <div class="tbl-cell">
                    <h3>Mantenimiento Usuario</h3>
                    <ol class="breadcrumb breadcrumb-simple">
                        <li><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                        <li class="active">Mantenimiento Usuario</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>

    <div class="box-typical box-typical-padding">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->apellido }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->estado)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </td>
                    <td>{{ ucfirst($user->rol ?? 'Sin Rol') }}</td>
                    <td>
                        <form action="{{ $user->estado ? route('users.deactivate', $user->id) : route('users.activate', $user->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button class="btn btn-sm {{ $user->estado ? 'btn-danger' : 'btn-success' }}">
                                {{ $user->estado ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Editar Rol</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
