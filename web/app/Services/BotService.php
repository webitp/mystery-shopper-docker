<?php

namespace App\Services;

class BotService {
    private $token;
    private $baseURL;

    public function __construct()
    {
        $this->token = env('BOT_TOKEN');
        $this->baseURL = 'https://api.telegram.org/';
    }

    public function sendRequest($method, $params = '')
    {
        $url = $this->baseURL . 'bot' . $this->token . '/' . $method . '?' . $params;
                      
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }

    public function sendMessage($chat_id, $message, $reply_markup = [])
    {
        return $this->sendRequest('sendMessage', 'chat_id=' . $chat_id . '&text=' . urlencode($message) . '&reply_markup=' . urlencode(json_encode($reply_markup)));
    }
}