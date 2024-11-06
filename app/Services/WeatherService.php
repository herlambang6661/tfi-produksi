<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherService
{
    /**
     * Create a new class instance.
     */
    protected $client;
    protected $apiKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
    }

    public function getWeatherByLocation($latitude, $longitude)
    {
        // URL endpoint API OpenWeatherMap
        $url = "https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&appid={$this->apiKey}&units=metric";

        // Melakukan request ke API dan mendapatkan data
        $response = $this->client->get($url);

        // Mengambil hasil dalam format JSON
        $data = json_decode($response->getBody()->getContents(), true);

        return $data;
    }
}
