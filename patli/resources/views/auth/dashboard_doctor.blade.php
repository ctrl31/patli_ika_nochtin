

@if($pacientes->where('urgencia', true)->count() > 0)
    <div id="urgenciasCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php $first = true; @endphp
            @foreach($pacientes as $paciente)
                @if($paciente->urgencia)
                    <div class="carousel-item {{ $first ? 'active' : '' }}">
                        <div class="alert alert-danger text-center">
                            <h4 class="fw-bold">🚨 Paciente Urgente</h4>
                            <p class="mb-0">{{ $paciente->nombres }} {{ $paciente->apellidos }}</p>
                            <!-- Aquí puedes añadir más info si quieres -->
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
    <div class="alert alert-success text-center">
        No hay pacientes urgentes por el momento.
    </div>
@endif

@section('peticiones')
<div class="row">
        @foreach($peticiones as $peticion)
        <div class="col-md-4 mb-4">
            <div class="card peticion-card" onclick="window.location='{{ route('doctor.peticiones.show', $peticion->id) }}'">
                <div class="card-body">
                    <h5 class="card-title">{{ $peticion->paciente->nombres }} {{ $peticion->paciente->apellidos }}</h5>
                    <p class="card-text">
                        <small class="text-muted">
                            {{ $peticion->created_at->diffForHumans() }}
                        </small>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{ $peticiones->links() }}
</div>

@endsection