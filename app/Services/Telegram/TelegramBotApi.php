<?php

namespace App\Services\Telegram;

use App\Services\Telegram\Exceptions\TelegramBotApiExceptions;
use Illuminate\Support\Facades\Http;
use Throwable;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';

    public static function sendMessage(string $token, int $chatID, string $message): bool
    {
        try {
            $response = Http::get(self::HOST . $token . '/sendMessage', [
                'chat_id' => $chatID,
                'text' => $message
            ])->throw()
                ->json();

            return $response['ok'] ?? false;
        } catch (Throwable $e) {
            report(new TelegramBotApiExceptions($e->getMessage()));

            return false;
        }
    }
}
