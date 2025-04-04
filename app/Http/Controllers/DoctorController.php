<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Paciente;
use App\Models\Peticion;
use Illuminate\Support\Facades\Auth;
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
    //Ruta view
    public function registraDoctor(){
        return view('register.registerDoctor');

    }
    public function dashboardDoctor(){	
        // Obtener todos los pacientes
    $pacientes = Paciente::all();

    // O también puedes filtrar desde aquí solo los urgentes
    // $pacientesUrgentes = Paciente::where('urgencia', true)->get();

    // Obtener las peticiones del doctor autenticado (ejemplo)
    $doctor = auth()->guard('doctor')->user();
    $peticiones = Peticion::where('idDoctor', $doctor->id)->with('paciente')->paginate(6);

    return view('dashboard.dashboardDoctor', compact('pacientes', 'peticiones'));
    }

    public function login(Request $request)
{
    $request->validate([
        'cedula' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::guard('doctor')->attempt(['cedula' => $request->cedula, 'password' => $request->password])) {
        $request->session()->regenerate();
        return redirect()->route('dashboardDoctor')->with('success', 'Has iniciado sesión correctamente.');
    }

    return back()->withErrors([
        'cedula' => 'Las credenciales no coinciden con nuestros registros.',
    ]);
}


public function listarPacientesUrgentes()
{
    $pacientesUrgentes = Paciente::where('urgencia', true)->get();

    return view('doctor.pacientes-urgentes', [
        'pacientes' => $pacientesUrgentes
    ]);
}
}
