@extends('layouts.app')
@section('title', 'Iniciar Sesión')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Sección de login responsiva -->
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
            <div class="card shadow-sm p-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">🩺 Iniciar Sesión</h2>
                    <!-- Formulario de login Paciente -->
                    <form action="{{ route('login.paciente') }}" method="POST">
                        @csrf
                        <!-- Campo de telefono -->
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Ingresa tu numero telefonico</label>
                            <input type="telefono" name="telefono" id="telefono" class="form-control" placeholder="Ingresa tu numero" required>
                            @error('telefono')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Campo de contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="********" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Botón de envío -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        </div>
                    </form>
                    <!-- Enlace de recuperación de contraseña -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between mt-3 text-center">
                        <a href="{{ route('registraPaciente') }}" class="text-decoration-none">Registrate</a>
                        <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection