<?php

namespace App\Http\Controllers;

use App\Services\OpenRouterService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $chatService;

    public function __construct(OpenRouterService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        try {
            $response = $this->chatService->getResponse($request->message);
            return response()->json(['reply' => $response]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error en el chatbot: ' . $e->getMessage()
            ], 500);
        }
    }
}
