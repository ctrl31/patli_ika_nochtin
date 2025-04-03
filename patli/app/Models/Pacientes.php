<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pacientes';

    protected $fillable = [
        'nombres',
        'apellidos',
        'telefono',
        'email',
        'fecha_nacimiento',
        'curp',
        'nss',
        'tipo_padecimiento',
        'descripcion',
        'sexo',
        'discapacidad',
        'peso',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'discapacidad' => 'boolean',
        'peso' => 'decimal:2',
        'email_verified_at' => 'datetime',
    ];
}
