<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckOpenAIKeyCommand extends Command
{
    protected $signature = 'check:openai-key';
    protected $description = 'Verifica la configuración de la clave OpenAI';

    public function handle()
    {
        $key = config('services.openai.key');

        if (empty($key)) {
            $this->error('OPENAI_API_KEY no está configurada en .env');
            return 1;
        }

        $this->info('OpenAI Key configurada correctamente');
        $this->line('Longitud: '.strlen($key));
        $this->line('Valor: '.substr($key, 0, 4).'...'.substr($key, -4));

        return 0;
    }
}
