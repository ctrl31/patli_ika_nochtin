<?php

namespace App\Http\Controllers;

use App\Models\Peticion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeticionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idDoctor' => 'required|exists:doctors,id'
        ]);

        // La eliminación de antiguas se maneja automáticamente en el modelo
        $peticion = Peticion::create([
            'idPaciente' => Auth::guard('paciente')->id(),
            'idDoctor' => $validated['idDoctor']
        ]);

        return response()->json([
            'success' => true,
            'peticion' => $peticion
        ], 201);
    }

    // Opcional: Endpoint para limpieza manual
    public function limpiarAntiguas()
    {
        $eliminadas = Peticion::where('created_at', '<=', now()->subDays(15))->delete();

        return response()->json([
            'eliminadas' => $eliminadas
        ]);
    }
}
