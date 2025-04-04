<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\PacienteController;

//Ruta homepage
Route::get('/', [HomeController::class, 'homepage']);

//funciones crear
Route::post('/registrarDoctor', [DoctorController::class,'registrarDoctor'])->name('registrar.doctor');
Route::post('/registrarPaciente', [PacienteController::class,'registrarPaciente'])->name('registrar.paciente');
//Rutas Registrar
Route::get('/registraDoctor', [DoctorController::class,'registraDoctor'])->name('registraDoctor');
Route::get('/registraPaciente', [PacienteController::class,'registraPaciente'])->name('registraPaciente');

Route::get('/login/doctor', function () {
    return view('auth.login_doctor');
})->name('login.doctor');

Route::get('/login/patient', function () {
    return view('auth.login_patient');
})->name('login.patient');



