<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PeticionController;

//Ruta homepage
Route::get('/', [HomeController::class, 'homepage'])->name('homepage');

//funciones crear
Route::post('/registrarDoctor', [DoctorController::class,'registrarDoctor'])->name('registrar.doctor');
Route::post('/registrarPaciente', [PacienteController::class,'registrarPaciente'])->name('registrar.paciente');
//Rutas Registrar
Route::get('/registraDoctor', [DoctorController::class,'registraDoctor'])->name('registraDoctor');
Route::get('/registrar-paciente', [PacienteController::class, 'registraPaciente'])->name('registrar.paciente');
Route::post('/registrar-paciente', [PacienteController::class, 'registrarPaciente'])->name('registrar.paciente.submit');


//Routes Login
Route::get('/loginDoctor', [AuthController::class,'loginDoctor'])->name('loginDoctor');
Route::get('/loginPaciente', [AuthController::class,'loginPaciente'])->name('loginPaciente');
Route::post('/paciente/logout', [PacienteController::class, 'logout'])->name('paciente.logout');



//Routes dashboard
Route::get('/dashboardDoctor', [DoctorController::class,'dashboardDoctor'])->name('dashboardDoctor');
Route::get('/dashboardPaciente', [PacienteController::class,'dashboardPaciente'])->name('dashboardPaciente');
//Routes Acceso
Route::post('/login-doctor', [DoctorController::class,'login'])->name(  'login.doctor');
Route::post('/login-paciente', [PacienteController::class,'login'])->name(  'login.paciente');
//
Route::get('/doctor/peticiones/{id}', [PeticionController::class, 'show'])->name('doctor.peticiones.show');


Route::put('/paciente/{id}/actualizar', [PacienteController::class, 'actualizarDatos'])->name('paciente.actualizar');

// Muestra el formulario para editar datos del paciente
Route::get('/paciente/editar', [PacienteController::class, 'editarDatos'])->name('paciente.editar');

// Procesa el update (ya lo tienes)
Route::put('/paciente/actualizar', [PacienteController::class, 'actualizarDatos'])->name('paciente.actualizar');

// Ruta para cerrar sesión del doctor
Route::post('/doctor/logout', [DoctorController::class, 'logout'])->name('doctor.logout');


Route::middleware(['auth:doctor'])->group(function () {
    // ... otras rutas del doctor ...
    Route::get('/doctor/pacientes/{paciente}', [DoctorController::class, 'showPaciente'])->name('doctor.pacientes.show');
});


// Dentro del grupo de rutas del doctor
Route::prefix('doctor')->group(function () {
    // ... otras rutas ...

    // Rutas para peticiones
    Route::delete('/peticiones/{peticion}', [DoctorPeticionController::class, 'destroy'])
         ->name('doctor.peticiones.destroy');

    Route::post('/peticiones/{peticion}/mensaje', [DoctorPeticionController::class, 'crearMensaje'])
         ->name('doctor.peticiones.mensaje');
});


Route::get('/doctor/peticion/{id}', [DoctorPeticionController::class, 'getPeticion'])->name('doctor.peticion.get');


