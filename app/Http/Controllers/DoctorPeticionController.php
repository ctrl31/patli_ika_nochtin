<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Peticion;
use App\Models\Mensajeria;
use Illuminate\Http\Request;

class DoctorPeticionController extends Controller
{
    public function index()
    {
        $doctorId = auth()->guard('doctor')->id();
        $peticiones = Peticion::with('paciente')
            ->where('idDoctor', $doctorId)
            ->orderBy('created_at', 'desc')
            ->paginate(5); // 5 peticiones por página

        return view('doctor.peticiones', compact('peticiones'));
    }

    public function show($id)
    {
        $peticion = Peticion::with('paciente')->findOrFail($id);
        $paciente = $peticion->paciente;

        // Calcular edad
        $edad = now()->diffInYears($paciente->fecha_nacimiento);

        // Construir mensaje dinámico
        $mensaje = "Hola me llamo {$paciente->nombres} {$paciente->apellidos}, soy un(a) {$paciente->sexo} de {$edad} años";

        if ($paciente->tipo_padecimiento && $paciente->tipo_padecimiento != 'ninguno') {
            $mensaje .= ", con {$paciente->tipo_padecimiento}";
        }

        if ($paciente->discapacidad) {
            $mensaje .= ", {$paciente->discapacidad}";
        }

        $mensaje .= " y me gustaría recibir atención.";

        return view('doctor.peticion-detalle', [
            'peticion' => $peticion,
            'mensaje' => $mensaje
        ]);
    }

    public function destroy($id)
    {
        Peticion::destroy($id);
        return back()->with('success', 'Petición eliminada');
    }

    public function crearMensaje(Request $request, $id)
    {
        $peticion = Peticion::findOrFail($id);

        Mensajeria::create([
            'idPaciente' => $peticion->idPaciente,
            'idDoctor' => $peticion->idDoctor,
            'mensaje' => $request->mensaje,
            'estatusMensaje' => 'enviado'
        ]);

        // Opcional: Eliminar la petición después de crear el mensaje
        $peticion->delete();

        return redirect()->route('doctor.peticiones')
            ->with('success', 'Mensaje enviado correctamente');
    }
}
