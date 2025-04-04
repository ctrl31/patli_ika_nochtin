<?php

namespace App\Services;

use OpenAI;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $apiKey = env('OPENAI_API_KEY');

        if (empty($apiKey)) {
            throw new \RuntimeException('OpenAI API key is not configured');
        }

        $this->client = OpenAI::client($apiKey);
    }
    public function getResponse($message)
    {
        try {
            $response = $this->client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Eres un asistente médico virtual especializado en primeros auxilios. Proporciona información clara y concisa.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $message
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);

            return $response->choices[0]->message->content;

        } catch (\Exception $e) {
            Log::error('Error en OpenAI: '.$e->getMessage());
            return 'Lo siento, estoy teniendo dificultades para responder. Por favor intenta más tarde.';
        }
    }
}
