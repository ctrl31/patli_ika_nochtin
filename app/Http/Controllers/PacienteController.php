<?php

namespace App\Http\Controllers;


use App\Models\Doctor;
use App\Models\Paciente;
use App\Models\Peticion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
            'urgencia' => false,
            // Los campos opcionales se omiten y tomarán valores null por defecto
        ]);

        Auth::guard('paciente')->login($paciente);

// Redirigir a la vista para actualizar datos
return redirect()->route('paciente.editar')->with('success', 'Registro exitoso, por favor completa tu información.');
    }
    //Ruta view
    public function registraPaciente(){
        return view('register.registerPaciente');
    }
    public function dashboardPaciente()
{
    $especialidad = request('especialidad');

    $doctores = Doctor::when($especialidad, function ($query, $especialidad) {
        return $query->where('especialidad', 'LIKE', "%{$especialidad}%");
    })->get();

    $paciente = auth()->guard('paciente')->user();

    return view('dashboard.dashboardPaciente', compact('doctores', 'paciente'));
}

    public function login(Request $request)
{
    $request->validate([
        'telefono' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::guard('paciente')->attempt(['telefono' => $request->telefono, 'password' => $request->password])) {
        $request->session()->regenerate();
        return redirect()->route('dashboardPaciente')->with('success', 'Has iniciado sesión correctamente.');
    }

    return back()->withErrors([
        'telefono' => 'Las credenciales no coinciden con nuestros registros.',
    ]);
}


public function actualizarDatos(Request $request)
{
    $paciente = auth()->guard('paciente')->user();

    $validated = $request->validate([
        // ... otras validaciones ...
        'urgencia' => 'sometimes|boolean',
    ]);

    // Para manejar el input como "Urgente"/"Malestar leve"
    if ($request->has('urgencia_text')) {
        $validated['urgencia'] = $request->urgencia_text === 'Urgente';
    }

    $paciente->update($validated);

    return response()->json([
        'message' => 'Datos actualizados correctamente',
        'paciente' => $paciente
    ]);
}
public function editarDatos()
{
    $paciente = auth()->guard('paciente')->user();
    return view('dashboard.editarDatos', compact('paciente'));
}

}
