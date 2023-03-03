<?php

namespace App\Services\Project;

use Illuminate\Support\Facades\Http;

/**
 * Class TelegramService.
 */
class TelegramService
{

    public function __construct() {

    }

    public static function sendMessage($text = 'UZIMEI', $chat_id = -1001894850181)
    {
        foreach (str_split($text, 3000) as $t) {
            Http::acceptJson()
                ->post('https://api.telegram.org/bot' . env('TELEGRAM_SYSTEM_TOKEN', '5897039896:AAG5Rr7ir4tgLN2Q-QE5jy3w9POpfZVUfSI') . '/sendMessage', [
                    'chat_id' =>  $chat_id,
                    'text' =>  mb_convert_encoding($t, 'UTF-8', 'UTF-8'),
                ])->throw(function ($response, $e) {
                    return $response;
                })
                ->json();
        }
    }



}
