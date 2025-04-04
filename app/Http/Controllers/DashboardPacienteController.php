<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPacienteController extends Controller
{
    /**
     * Mostrar el dashboard del paciente
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener el paciente autenticado
        $paciente = Auth::guard('paciente')->user();

        // Verificar si el paciente está autenticado
        if (!$paciente) {
            return redirect()->route('login.paciente')->with('error', 'Por favor inicia sesión primero');
        }

        // Datos que podrías pasar a la vista
        $data = [
            'paciente' => $paciente,
            'nombreCompleto' => $paciente->nombres . ' ' . $paciente->apellidos,
            'urgencia' => $paciente->urgencia ? 'Urgente' : 'Malestar leve',
            'ultimaActualizacion' => $paciente->updated_at->format('d/m/Y H:i'),
        ];

        return view('dashboard.dashboardPaciente', $data);
    }
}
