<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeather(Request $request)
    {
        $lat = $request->lat;
        $lon = $request->lon;
        $weatherApiKey = 'c8727c5c4c23e56945aa7967d23f0a89';

        try {
            $weatherResponse = Http::get("http://api.openweathermap.org/data/2.5/weather", [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $weatherApiKey,
                'units' => 'metric',
                'lang' => 'id',
            ]);

            if ($weatherResponse->successful()) {
                $weatherData = $weatherResponse->json();
                $temperature = $weatherData['main']['temp'];
                $condition = $weatherData['weather'][0]['description'];
                $icon = $weatherData['weather'][0]['icon'];
                $address = $weatherData['name'] . ', ' . $weatherData['sys']['country'];

                return response()->json([
                    'temperature' => $temperature,
                    'condition' => $condition,
                    'icon' => $icon,
                    'address' => $address
                ]);
            } else {
                Log::error("Weather API request failed with status: " . $weatherResponse->status());
                return response()->json(['error' => 'Failed to fetch weather data.'], 500);
            }
        } catch (\Exception $e) {
            Log::error("Error fetching weather data: " . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching weather data: ' . $e->getMessage()], 500);
        }
    }
}
