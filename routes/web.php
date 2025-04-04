<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PacienteController;

//Ruta homepage
Route::get('/', [HomeController::class, 'homepage']);


//Rutas Registrar
Route::get('/registraDoctor', [DoctorController::class,'registraDoctor'])->name('registraDoctor');
Route::get('/registraPaciente', [PacienteController::class,'registraPaciente'])->name('registraPaciente');

/* sugerencia de ruta para actualizar datos
Route::middleware(['auth:paciente'])->group(function () {
    Route::put('/paciente/actualizar-datos', [PacienteController::class, 'actualizarDatos']);
});*/
