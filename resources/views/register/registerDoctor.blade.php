@extends('layouts.app')

@section('title', 'Registro Doctor')

@section('content')
<!-- Sección de Registro -->
<div class="py-5 bg-light">
    <div class="container">
        <h1 class="text-center mb-5">Antes de comenzar...</h1>
        <div class="row justify-content-center align-items-center">
            <!-- Columna Izquierda (Imagen + Mensaje) -->
            <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                <img src="{{ asset('images/icon-5.png') }}" alt="Icono Doctor" class="img-fluid mb-3" style="max-width: 120px;">
                <h5 class="text-muted">Puedes apoyarnos a contribuir, regístrate y apoya a la gente que más lo necesita.</h5>
            </div>

            <!-- Columna Derecha (Formulario) -->
            <div class="col-lg-6">
                <div class="card shadow p-4 border-0">
                    <h3 class="text-center mb-4">Regístrate</h3>
                    <form action="{{ route('registrar.doctor') }}" method="POST">
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
                            <label for="cedula" class="form-label">Ingresa tu Cedula</label>
                            <input type="text" id="cedula" class="form-control" name="cedula" placeholder="Ingresa tu cedula" required>
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
                            <label for="especialidad">Especialidad</label>

                            <select class="form-control" id="especialidad" name="especialidad" required>
                                <option value="" disabled selected>Selecciona una especialidad</option>
                                <option value="Cardiología">Especialista en Cardiología</option>
                                <option value="Endocrinología">Especialista en Endocrinología</option>
                                <option value="Neumología">Especialista en Neumología</option>
                                <option value="Neurología">Especialista en Neurología</option>
                                <option value="Reumatología">Especialista en Reumatología</option>
                                <option value="Gastroenterología">Especialista en Gastroenterología</option>
                                <option value="Nefrología">Especialista en Nefrología</option>
                                <option value="Oftalmología">Especialista en Oftalmología</option>
                                <option value="Psiquiatría">Especialista en Psiquiatría</option>
                                <option value="Medicina Interna">Especialista en Medicina Interna</option>
                                <option value="Geriatría">Especialista en Geriatría</option>
                                <option value="Dermatología">Especialista en Dermatología</option>
                                <option value="Oncología">Especialista en Oncología</option>
                                <option value="Hematología">Especialista en Hematología</option>
                            </select>
                            
                      
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
