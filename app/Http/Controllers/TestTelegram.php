<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class TestTelegram extends Controller
{
    // public function index() {
    //     $response = Http::withoutVerifying()
    //     ->post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
    //         'chat_id' => '-1001907693109',
    //         'text' => 'Votre message ici',
    //     ]);
    // }

    public function sendMessageToTelegram($data)
    {

        try {
            $response = Http::withoutVerifying()
            ->post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage", [
                'chat_id' => env('TELEGRAM_CHAT_ID'),
                'text' => $data,
            ]);

            if ($response->successful()) {
                return response()->json(['message' => 'Message envoyé avec succès'], 200);
            } else {
                return response()->json(['error' => 'Erreur lors de l\'envoi du message'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de l\'envoi du message'], 500);
        }
    }
}
