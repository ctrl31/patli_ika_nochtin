<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenRouterService
{
    protected $apiKey;
    protected $baseUrl = 'https://openrouter.ai/api/v1';

    public function __construct()
    {
        $this->apiKey = env('OPENROUTER_API_KEY');
    }

    public function getResponse(string $message, string $model = null): string
    {
        $model = $model ?? env('OPENROUTER_MODEL');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'HTTP-Referer' => env('APP_URL', 'https://yourdomain.com'),
            'X-Title' => 'Asistente Médico'
        ])->post("{$this->baseUrl}/chat/completions", [
            'model' => $model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Eres un asistente médico virtual especializado en primeros auxilios.'
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ],
            'temperature' => 0.7,
            'max_tokens' => 500
        ]);

        if ($response->failed()) {
            throw new \Exception("Error en OpenRouter: " . $response->body());
        }

        return $response->json()['choices'][0]['message']['content'];
    }
}
