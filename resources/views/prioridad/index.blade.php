@extends('layouts.app') 

@section('titulo', 'Mantenimiento de Prioridades')

@section('content')
<!-- Contenido de la vista -->
<div class="container">
    <h1>Mantenimiento de Prioridades</h1>
    <button class="btn btn-primary" id="btnNuevo">Nueva Prioridad</button>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prioridades as $prioridad)
                <tr>
                    <td>{{ $prioridad->prio_nom }}</td>
                    <td>
                        <button class="btn btn-warning" onclick="editar({{ $prioridad->prio_id }})">Editar</button>
                        <button class="btn btn-danger" onclick="eliminar({{ $prioridad->prio_id }})">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal para crear o editar prioridades -->
<div class="modal fade" id="modalPrioridad" tabindex="-1" aria-labelledby="modalPrioridadLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formPrioridad" method="POST" action="{{ route('prioridad.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPrioridadLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="prio_id" name="prio_id" value="">
                    <div class="mb-3">
                        <label for="prio_nom" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="prio_nom" name="prio_nom" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#btnNuevo').click(function () {
        $('#prio_id').val(''); 
        $('#prio_nom').val('');
        $('#modalPrioridadLabel').text('Nueva Prioridad');
        $('#modalPrioridad').modal('show');
    });

    function editar(prioId) {
    // Simula una llamada AJAX para obtener datos (implementa en tu controlador si no está disponible)
    $.ajax({
        url: `/admin/prioridad/${prioId}/edit`,
        method: 'GET',
        success: function (data) {
            $('#prio_id').val(data.prio_id); // Asigna el id de la prioridad al campo oculto
            $('#prio_nom').val(data.prio_nom); // Asigna el nombre de la prioridad
            $('#modalPrioridadLabel').text('Editar Prioridad');
            $('#modalPrioridad').modal('show');
        },
        error: function () {
            alert('Error al obtener los datos de la prioridad.');
        }
    });
}
</script>
@endsection
