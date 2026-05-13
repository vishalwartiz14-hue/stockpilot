<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function send(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [

            'model' => 'llama-3.1-8b-instant',

            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are an AI assistant for a Laravel web application. 
You help users navigate the project, explain features, and answer questions about the system. 
Be concise, friendly, and technical when needed.'
                ],
                [
                    'role' => 'user',
                    'content' => $request->message
                ]
            ],
        ]);

        $data = $response->json();

        // Check if API returned error
        if (isset($data['error'])) {

            return response()->json([
                'reply' => 'Groq API Error',
                'error' => $data['error']['message']
            ]);
        }

        return response()->json([
            'reply' => $data['choices'][0]['message']['content']
        ]);
    }
}