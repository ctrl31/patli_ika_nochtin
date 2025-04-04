@extends('layouts.app')
@section('title', 'Iniciar Sesión')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Sección de login centrada -->
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">🩺 Iniciar Sesión</h2>
                    <!-- Formulario de login Doctor -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <!-- Campo de cedula -->
                        <div class="mb-3">
                            <label for="cedula" class="form-label">Ingresa tu cedula</label>
                            <input type="cedula" name="email" id="email" class="form-control" placeholder="correo@ejemplo.com" required>
                            @error('email')
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
                    <div class="text-center mt-3">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
