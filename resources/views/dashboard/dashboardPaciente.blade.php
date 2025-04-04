@extends('layouts.app')

@section('title','dashboard Paciente')

@section('content')

<div class="container mt-4">
    <h2 class="text-center mb-4">Buscar Doctores por Especialidad</h2>

    <form method="GET" action="{{ route('dashboard.paciente') }}" class="mb-4 row">
        <div class="col-md-10">
            <input type="text" name="especialidad" class="form-control" placeholder="Ingresa la especialidad (ej. Cardiología)" value="{{ request('especialidad') }}">
        </div>
        <div class="col-md-2 text-end">
            <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>
    </form>

    <div class="row">
        @forelse($doctores as $doctor)
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $doctor->nombres }} {{ $doctor->apellidos }}</h5>
                        <p class="card-text">Especialidad: {{ $doctor->especialidad }}</p>
                        <p class="card-text">Email: {{ $doctor->email }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning text-center">
                No se encontraron doctores con esa especialidad.
            </div>
        @endforelse
    </div>
</div>

@endsection