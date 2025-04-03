<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    /**
     */
    public function registrarPaciente(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|email|max:100|unique:pacientes',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|string|max:10',
            'password' => 'required|string|min:8',
        ]);

        $paciente = Paciente::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'sexo' => $request->sexo,
            'password' => Hash::make($request->password),
            // Los campos opcionales se omiten y tomarán valores null por defecto
        ]);

        return response()->json([
            'message' => 'Paciente registrado exitosamente',
            'paciente' => $paciente
        ], 201);
    }
    //Ruta view
    public function registraPaciente(){
        return view('register.registerPaciente');
    }
}
