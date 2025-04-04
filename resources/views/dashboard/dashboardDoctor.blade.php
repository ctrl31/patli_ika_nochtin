    @extends('layouts.app')
    @section('title','Navegador Doctor')

    @section('content')
    <div class="d-flex justify-content-end">
        <form action="{{ route('doctor.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </form>
    </div>

    <div>
        <h1 class="text-center">¡Hola, Doctor!</h1>

        <!-- Sección de Pacientes Urgentes (Carousel) -->
        @if($pacientes->where('urgencia', true)->count() > 0)
        <div id="urgenciasCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php $first = true; @endphp
                @foreach($pacientes as $paciente)
                    @if($paciente->urgencia)
                        <div class="carousel-item {{ $first ? 'active' : '' }}">
                            <div class="alert alert-danger text-center">
                                <h4 class="fw-bold">🚨 Paciente Urgente</h4>
                                <p class="mb-0">{{ $paciente->nombres }} {{ $paciente->apellidos }} - {{ $paciente->tipo_padecimiento ?? 'Sin diagnóstico' }}</p>
                                <p class="mb-0">{{ $paciente->descripcion ?? 'Sin descripción' }}</p>
                            </div>
                        </div>
                        @php $first = false; @endphp
                    @endif
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#urgenciasCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#urgenciasCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
            </div>
        @else
            <div class="alert alert-success text-center mb-5">
                No hay pacientes urgentes por el momento.
            </div>
        @endif

        <!-- Sección de Todos los Pacientes - Acordeón -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Listado de Todos los Pacientes</h3>
            </div>
            <div class="card-body">
                <div class="accordion" id="pacientesAccordion">
                    @foreach($pacientes as $index => $paciente)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                <span class="me-3">{{ $paciente->nombres }} {{ $paciente->apellidos }}</span>
                                <span class="badge {{ $paciente->urgencia ? 'bg-danger' : 'bg-success' }}">
                                    {{ $paciente->urgencia ? 'Urgente' : 'Estable' }}
                                </span>
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#pacientesAccordion">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Información Básica</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>Teléfono:</strong> {{ $paciente->telefono }}</li>
                                            <li class="list-group-item"><strong>Email:</strong> {{ $paciente->email }}</li>
                                            <li class="list-group-item"><strong>Fecha Nacimiento:</strong> {{ optional($paciente->fecha_nacimiento)->format('d/m/Y') }}</li>
                                            <li class="list-group-item"><strong>Sexo:</strong> {{ $paciente->sexo == 'M' ? 'Masculino' : 'Femenino' }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Historial Médico</h5>
                                        <div class="card">
                                            <div class="card-body">
                                                @if(optional($paciente->peticiones)->count() > 0)
                                                    @foreach($paciente->peticiones as $peticion)
                                                        <div class="mb-3 border-bottom pb-2">
                                                            <h6>{{ $peticion->titulo ?? 'Consulta' }}</h6>
                                                            <p>{{ $peticion->descripcion ?? 'Sin descripción' }}</p>
                                                            <small class="text-muted">{{ $peticion->created_at->diffForHumans() }}</small>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-muted">No hay historial registrado</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Paginación de Pacientes -->
                @if($pacientes instanceof \Illuminate\Pagination\LengthAwarePaginator && $pacientes->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $pacientes->links() }}
                </div>
                @endif
            </div>
        </div>

        <!-- Sección de Peticiones Recientes -->
        <div class="card-body">
    <div class="row">
        @forelse($peticiones as $peticion)
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100 peticion-card"
                     style="cursor: pointer;"
                     data-bs-toggle="modal"
                     data-bs-target="#peticionModal{{ $peticion->id }}"
                     data-id="{{ $peticion->id }}"
                     data-titulo="{{ $peticion->titulo ?? 'Consulta' }}"
                     data-descripcion="{{ $peticion->descripcion ?? 'Sin descripción' }}"
                     data-paciente="{{ $peticion->paciente->nombres }} {{ $peticion->paciente->apellidos }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $peticion->paciente->nombres }} {{ $peticion->paciente->apellidos }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $peticion->titulo ?? 'Consulta' }}</h6>
                        <p class="card-text">{{ Str::limit($peticion->descripcion ?? 'Sin descripción', 100) }}</p>
                        <small class="text-muted">{{ $peticion->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No hay peticiones recientes</div>
            </div>
        @endforelse
    </div>
</div>



                <!-- Modal para cada petición -->
                <div class="modal fade" id="peticionModal{{ $peticion->id }}" tabindex="-1" aria-labelledby="peticionModalLabel{{ $peticion->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="peticionModalLabel{{ $peticion->id }}">Detalles de Petición</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="mensajeContenido{{ $peticion->id }}" class="mb-4">
                                    <!-- Aquí se cargará dinámicamente el mensaje -->
                                </div>

                                <form id="mensajeForm{{ $peticion->id }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="respuesta{{ $peticion->id }}" class="form-label">Tu respuesta:</label>
                                        <textarea class="form-control" id="respuesta{{ $peticion->id }}" name="mensaje" rows="3" required></textarea>
                                    </div>
                                </form>
                            </div>
                            @forelse ($peticiones as $peticion) 
                            <div class="modal-footer">
                                <form action="{{ route('doctor.peticiones.destroy', $peticion->id) }}" method="POST" class="me-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Eliminar Petición
                                    </button>
                                </form>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" onclick="enviarMensaje({{ $peticion->id }})">
                                    <i class="fas fa-paper-plane"></i> Enviar Mensaje
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">No hay peticiones recientes</div>
                </div>
            @endforelse
        </div>

        <!-- Paginación de Peticiones -->
        @if($peticiones instanceof \Illuminate\Pagination\LengthAwarePaginator && $peticiones->hasPages())
        <div class="d-flex justify-content-center">
            {{ $peticiones->links() }}
        </div>
        @endif
    </div>
</div>

    </div>

    <script>
    function enviarMensaje(peticionId) {
        const form = document.getElementById(`mensajeForm${peticionId}`);
        const formData = new FormData(form);

        fetch(`/doctor/peticiones/${peticionId}/mensaje`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert(data.message);
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al enviar el mensaje');
        });
    }
    </script>
    @endsection

    @push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const peticionCards = document.querySelectorAll('.peticion-card');
    peticionCards.forEach(card => {
        card.addEventListener('click', function() {
            const peticionId = card.getAttribute('data-id');
            const titulo = card.getAttribute('data-titulo');
            const descripcion = card.getAttribute('data-descripcion');
            const paciente = card.getAttribute('data-paciente');

            const mensajeContenido = document.getElementById(`mensajeContenido${peticionId}`);

            // Construir el mensaje
            const mensaje = `Hola me llamo ${paciente}, ${descripcion ? 'con el siguiente mensaje: ' + descripcion : 'sin descripción'}.`;

            // Actualizar el modal con los datos dinámicamente
            mensajeContenido.innerHTML = `
                <h6>Mensaje del paciente:</h6>
                <div class="alert alert-light border">
                    <p class="mb-0">${mensaje}</p>
                </div>
            `;
        });
    });
});
</script>
@endpush
