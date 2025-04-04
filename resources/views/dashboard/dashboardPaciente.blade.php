@extends('layouts.app')

@section('title', 'Dashboard Paciente')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Bienvenido, {{ $nombreCompleto }}</h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Información del Paciente</h5>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Email:</strong> {{ $paciente->email }}</li>
                                <li class="list-group-item"><strong>Teléfono:</strong> {{ $paciente->telefono }}</li>
                                <li class="list-group-item"><strong>Fecha Nacimiento:</strong> {{ $paciente->fecha_nacimiento->format('d/m/Y') }}</li>
                                <li class="list-group-item"><strong>Sexo:</strong> {{ $paciente->sexo == 'M' ? 'Masculino' : 'Femenino' }}</li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <h5>Estado Actual</h5>
                            <div class="card {{ $paciente->urgencia ? 'bg-warning' : 'bg-light' }}">
                                <div class="card-body">
                                    <h5 class="card-title">Prioridad: {{ $urgencia }}</h5>
                                    <p class="card-text">Última actualización: {{ $ultimaActualizacion }}</p>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#actualizarEstadoModal">
                                        Actualizar estado
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de peticiones/historial podría ir aquí -->
                </div>

                <div class="card-footer text-end">
                    <form action="{{ route('paciente.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para actualizar estado -->
<div class="modal fade" id="actualizarEstadoModal" tabindex="-1" aria-labelledby="actualizarEstadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actualizarEstadoModalLabel">Actualizar estado de salud</h5>
                <button type="button" class="btn-close" data-bs-close="modal" aria-label="Close"></button>
            </div>
            <form id="actualizarEstadoForm" method="POST" action="{{ route('paciente.actualizar') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">¿Cómo te sientes?</label>
                        <select class="form-select" name="urgencia_text">
                            <option value="Malestar leve" {{ !$paciente->urgencia ? 'selected' : '' }}>Malestar leve</option>
                            <option value="Urgente" {{ $paciente->urgencia ? 'selected' : '' }}>Urgente</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Puedes añadir JavaScript para manejar la actualización AJAX si lo prefieres
    document.getElementById('actualizarEstadoForm').addEventListener('submit', function(e) {
        e.preventDefault();

        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                urgencia_text: this.querySelector('[name="urgencia_text"]').value
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.message) {
                alert(data.message);
                window.location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
@endsection
