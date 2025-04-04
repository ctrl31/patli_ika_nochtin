@extends('layouts.app')
@section('title','Editar Datos')

@section('content')
<div class="py-5 bg-light">
    <div class="container">
        <h1 class="text-center mb-5">Necesitas apoyo clinico?</h1>
        <div class="row justify-content-center align-items-center">
            <!-- Columna Izquierda (Imagen + Mensaje) -->
            <div class="col-lg-6 mb-4 mb-lg-0 text-center">
              
                <h5 class="text-muted">Un profesional de la salud atendera tu caso lo antes posible el primer paso es registrarte.</h5>
            </div>

            <!-- Columna Derecha (Formulario) -->
            <div class="col-lg-6">
                <div class="card shadow p-4 border-0">
                    <h3 class="text-center mb-4">Regístrate</h3>
<form action="{{ route('paciente.actualizar', $paciente->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Teléfono:</label>
        <input type="text" name="telefono" value="{{ old('telefono', $paciente->telefono) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $paciente->email) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>CURP:</label>
        <input type="text" name="curp" value="{{ old('curp', $paciente->curp) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>NSS:</label>
        <input type="text" name="nss" value="{{ old('nss', $paciente->nss) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tipo de Padecimiento:</label>
        <input type="text" name="tipo_padecimiento" value="{{ old('tipo_padecimiento', $paciente->tipo_padecimiento) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Descripción:</label>
        <textarea name="descripcion" class="form-control">{{ old('descripcion', $paciente->descripcion) }}</textarea>
    </div>

    <div class="mb-3">
        <label>Discapacidad:</label>
        <input type="text" name="discapacidad" value="{{ old('discapacidad', $paciente->discapacidad) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Peso:</label>
        <input type="number" name="peso" step="0.1" value="{{ old('peso', $paciente->peso) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>¿Urgencia?</label>
        <select name="urgencia" class="form-control">
            <option value="0" {{ !$paciente->urgencia ? 'selected' : '' }}>No</option>
            <option value="1" {{ $paciente->urgencia ? 'selected' : '' }}>Sí</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection