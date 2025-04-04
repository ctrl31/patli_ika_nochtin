<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensajeria extends Model
{
    protected $table = 'mensajeria';

    protected $fillable = [
        'idPaciente',
        'idDoctor',
        'mensaje',
        'estatusMensaje'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'idPaciente');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'idDoctor');
    }
}
