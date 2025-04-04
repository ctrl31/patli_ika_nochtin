<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Paciente extends Model
{
    use HasFactory, SoftDeletes;
    use HasApiTokens, Notifiable;

    protected $table = 'pacientes';

    protected $fillable = [
        // ... otros campos ...
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
        'urgencia',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'discapacidad' => 'boolean',
        'peso' => 'decimal:2',
        'email_verified_at' => 'datetime',
        'tipo_padecimiento' => 'string',
        'urgencia' => 'boolean',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
}
