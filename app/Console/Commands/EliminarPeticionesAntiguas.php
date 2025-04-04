<?php

namespace App\Console\Commands;

use App\Models\Peticion;
use Illuminate\Console\Command;

class EliminarPeticionesAntiguas extends Command
{
    protected $signature = 'peticiones:eliminar-antiguas';
    protected $description = 'Elimina peticiones con más de 15 días';

    public function handle()
    {
        $count = Peticion::antiguas()->delete();
        $this->info("Se eliminaron {$count} peticiones antiguas.");
        return 0;
    }
}
