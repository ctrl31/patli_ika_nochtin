
@extends('layouts.app')

@section('title', 'Registro Paciente')

@section('content')
<!-- Sección de Registro -->
<div class="py-5 bg-light">
    <div class="container">
        <h1 class="text-center mb-5">Necesitas apoyo clinico?</h1>
        <div class="row justify-content-center align-items-center">
            <!-- Columna Izquierda (Imagen + Mensaje) -->
            <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                <img src="{{ asset('images/icon-2.png') }}" alt="Icono Doctor" class="img-fluid mb-3" style="max-width: 120px;">
                <h5 class="text-muted">Un profesional de la salud atendera tu caso lo antes posible el primer paso es registrarte.</h5>
            </div>

            <!-- Columna Derecha (Formulario) -->
            <div class="col-lg-6">
                <div class="card shadow p-4 border-0">
                    <h3 class="text-center mb-4">Regístrate</h3>
                    <form action="{{ route('registrar.paciente') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombre(s)</label>
                            <input type="text" id="nombres" class="form-control" name="nombres" placeholder="Ingresa tu nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" id="apellidos" class="form-control" name="apellidos" placeholder="Ingresa tus apellidos" required>
                        </div>
                     
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Tu telefono</label>
                            <input type="text" id="telefono" class="form-control" name="telefono" placeholder="Ingresa tu telefono" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="correo@ejemplo.com" required>
                        </div>
                      
                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                        
                        <label for="sex">Sexo</label>

                        <select class="form-control" id="sexo" name="sexo" required>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="********" required>
                        </div>

                     

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Registrate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- End row -->
    </div> <!-- End container -->
</div> <!-- End section -->
@endsection
