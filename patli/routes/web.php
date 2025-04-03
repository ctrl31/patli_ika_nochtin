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



