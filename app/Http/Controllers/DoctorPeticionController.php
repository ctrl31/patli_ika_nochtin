<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peticion;
use App\Models\Mensajeria;

class DoctorPeticionController extends Controller
{
    public function index()
    {
        $doctorId = Auth::guard('doctor')->id();
        $peticiones = Peticion::with('paciente')
            ->where('idDoctor', $doctorId)
            ->latest()
            ->paginate(5);

        return view('doctor.peticiones', compact('peticiones'));
    }

    public function show(Peticion $peticion)
    {
        $paciente = $peticion->paciente;
        $edad = now()->diffInYears($paciente->fecha_nacimiento);

        $mensaje = "Hola, me llamo {$paciente->nombres} {$paciente->apellidos}, soy un(a) {$paciente->sexo} de {$edad} años";

        if (!empty($paciente->tipo_padecimiento) && $paciente->tipo_padecimiento !== 'ninguno') {
            $mensaje .= ", con {$paciente->tipo_padecimiento}";
        }

        if (!empty($paciente->discapacidad)) {
            $mensaje .= ", {$paciente->discapacidad}";
        }

        $mensaje .= " y me gustaría recibir atención.";

        return view('doctor.peticion-detalle', compact('peticion', 'mensaje'));
    }

    public function crearMensaje(Request $request, Peticion $peticion)
    {
        $request->validate([
            'mensaje' => 'required|string|min:10',
        ]);

        Mensajeria::create([
            'idPaciente' => $peticion->idPaciente,
            'idDoctor' => $peticion->idDoctor,
            'mensaje' => $request->mensaje,
            'estatusMensaje' => 'enviado',
        ]);

        $peticion->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mensaje enviado correctamente',
        ]);
    }

    public function destroy(Peticion $peticion)
    {
        $peticion->delete();

        return back()->with('success', 'Petición eliminada correctamente');
    }


    public function getPeticion($id)
{
    $peticion = Peticion::with('paciente')->findOrFail($id);
    $paciente = $peticion->paciente;

    $edad = now()->diffInYears($paciente->fecha_nacimiento);

    // Construimos el mensaje dinámico
    $mensaje = "Hola, me llamo {$paciente->nombres} {$paciente->apellidos}, soy un(a) {$paciente->sexo} de {$edad} años";

    if (!empty($paciente->tipo_padecimiento) && $paciente->tipo_padecimiento !== 'ninguno') {
        $mensaje .= ", con {$paciente->tipo_padecimiento}";
    }

    if (!empty($paciente->discapacidad)) {
        $mensaje .= ", {$paciente->discapacidad}";
    }

    $mensaje .= " y me gustaría recibir atención.";

    return response()->json([
        'success' => true,
        'mensaje' => $mensaje,
        'peticion_id' => $peticion->id,
    ]);
}

}
