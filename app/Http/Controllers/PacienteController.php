<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function login(Request $request)
{
    $request->validate([
        'telefono' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::guard('paciente')->attempt(['telefono' => $request->telefono, 'password' => $request->password])) {
        $request->session()->regenerate();
        return redirect()->intended('/paciente/dashboard');
    }

    return back()->withErrors([
        'telefono' => 'Las credenciales no coinciden con nuestros registros.',
    ]);
}


public function actualizarDatos(Request $request)
{
    $paciente = auth()->guard('paciente')->user();

    $validated = $request->validate([
        'telefono' => 'sometimes|string|max:20',
        'email' => [
            'sometimes',
            'email',
            'max:100',
            Rule::unique('pacientes')->ignore($paciente->id)
        ],
        'fecha_nacimiento' => 'sometimes|date',
        'curp' => 'sometimes|string|max:18',
        'nss' => 'nullable|string|max:20',
        'tipo_padecimiento' => [
            'nullable',
            'string',
            Rule::in(['cronico', 'agudo', 'ninguno'])
        ],
        'descripcion' => 'nullable|string',
        'sexo' => 'sometimes|string|max:10',
        'discapacidad' => 'sometimes|boolean',
        'peso' => 'nullable|numeric|between:0,300',
    ]);

    // Convertir CURP a mayúsculas si está presente
    if (isset($validated['curp'])) {
        $validated['curp'] = strtoupper($validated['curp']);
    }

    $paciente->update($validated);

    return response()->json([
        'message' => 'Datos actualizados correctamente',
        'paciente' => $paciente
    ]);
}
}
