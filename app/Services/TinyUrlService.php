<?php
// app/Services/TinyUrlService.php

namespace App\Services;

use GuzzleHttp\Client;

class TinyUrlService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function shortenUrl($longUrl)
    {
        $response = $this->client->post('https://tinyurl.com/api-create.php', [
            'form_params' => [
                'url' => $longUrl,
            ],
        ]);

        return $response->getBody()->getContents();
    }
}
