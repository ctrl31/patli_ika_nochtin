@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Listado de Peticiones</h2>

    <!-- Tabla con las peticiones -->
    <table class="table">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peticiones as $peticion)
            <tr>
                <td>{{ $peticion->paciente->nombres }} {{ $peticion->paciente->apellidos }}</td>
                <td>{{ $peticion->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <!-- Botón para cargar datos de la petición -->
                    <button class="btn btn-primary btn-cargar" data-id="{{ $peticion->id }}">Ver Detalle</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $peticiones->links() }}
    </div>

    <!-- Sección donde se mostrará el mensaje de la petición -->
    <div id="detalle-peticion" class="mt-4" style="display: none;">
        <h4>Detalle de la Petición</h4>
        <label id="mensaje-peticion" class="form-control"></label>

        <!-- Botones para acciones -->
        <button id="btn-eliminar" class="btn btn-danger" style="display: none;">Eliminar Petición</button>
        <button id="btn-responder" class="btn btn-success" style="display: none;">Responder</button>
    </div>
</div>

<!-- Scripts de AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-cargar').click(function () {
            let peticionId = $(this).data('id');

            $.ajax({
                url: '/doctor/peticion/' + peticionId,
                method: 'GET',
                success: function (response) {
                    if (response.success) {
                        $('#mensaje-peticion').text(response.mensaje);
                        $('#detalle-peticion').show();
                        $('#btn-eliminar, #btn-responder').show().data('id', peticionId);
                    }
                },
                error: function () {
                    alert('Error al obtener la petición.');
                }
            });
        });

        $('#btn-eliminar').click(function () {
            let peticionId = $(this).data('id');

            $.ajax({
                url: '/doctor/peticion/' + peticionId,
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function () {
                    alert('Error al eliminar la petición.');
                }
            });
        });

        $('#btn-responder').click(function () {
            let peticionId = $(this).data('id');
            let mensaje = prompt('Escribe tu mensaje:');

            if (mensaje && mensaje.length >= 10) {
                $.ajax({
                    url: '/doctor/peticion/' + peticionId + '/mensaje',
                    method: 'POST',
                    data: { mensaje: mensaje, _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function () {
                        alert('Error al enviar el mensaje.');
                    }
                });
            } else {
                alert('El mensaje debe tener al menos 10 caracteres.');
            }
        });
    });
</script>
@endsection
