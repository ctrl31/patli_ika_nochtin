<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Peticion extends Model
{
    protected $table = 'peticiones';

    protected $fillable = ['idPaciente', 'idDoctor'];

    protected static function booted()
    {
        static::created(function ($peticion) {
            // Eliminar peticiones antiguas (15+ días) al crear una nueva
            DB::table('peticiones')
                ->where('created_at', '<=', now()->subDays(15))
                ->delete();
        });
    }

    // Relaciones
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'idDoctor');
    }
}
