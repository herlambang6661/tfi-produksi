<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\WeatherService;

class DashboardController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
        $this->middleware('auth');
        Auth::check();
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
    }
    public function dashboard()
    {
        $latitude = session('latitude');
        $longitude = session('longitude');
        $activity = ActivityLog::getLogs();

        if (!$latitude || !$longitude) {
            return view('products.dashboard', [
                'active' => 'Dashboard',
                'judul' => 'Dashboard',
                'weatherData' => 'N/A',
                'activity' => $activity,
            ]);
        }

        $currentWeatherData = $this->weatherService->getCurrentWeatherData($latitude, $longitude);
        // dd($currentWeatherData);
        if (Auth::check()) {
            return view('products.dashboard', [
                'active' => 'Dashboard',
                'judul' => 'Dashboard',
                'weatherData' => $currentWeatherData,
                'activity' => $activity,
            ]);
        }
        return redirect("/")->withErrors(['error' => 'Opps! You do not have access'])->withInput();
    }
}
