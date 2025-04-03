<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Registra un nuevo doctor
     */
    public function registrarDoctor(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'cedula' => 'required|string|max:20|unique:doctors',
            'telefono' => 'required|string|max:20',
            'email' => 'required|string|email|max:100|unique:doctors',
            'especialidad' => 'required|string|max:100',
            'sexo' => 'required|string|max:10',
            'password' => 'required|string|min:8',
        ]);

        $doctor = Doctor::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'cedula' => $request->cedula,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'especialidad' => $request->especialidad,
            'sexo' => $request->sexo,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Doctor registrado exitosamente',
            'doctor' => $doctor
        ], 201);
    }
}
