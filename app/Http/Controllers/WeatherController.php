<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherController extends Controller
{
    public function getSearchCurrent()
    {
        $location = "Hyderabad";
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $location,
            'APPID' => env('OPENWEATHER_API_KEY'),
            'units' => "metric",
            'exclude' => 'hourly,daily'
        ]);
        if ($response->successful()) {
            $currentWeatherData = $response->json();
            return view('home', compact('currentWeatherData'));
        }
        else {
            return back()->with('error', 'Failed to retrieve weather data');
        }
    }

    public function sendData(Request $request)
    {
        $data = $request->input('data');
        $link = $request->input('link');
        $units = 'metric';
        switch ($link) {
            case 'searchCurrent':
                if ($data) {
                    $loc = $data;
                } else {
                    $loc = "Hyderabad";
                }
                $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                    'q' => $loc,
                    'APPID' => env('OPENWEATHER_API_KEY'),
                    'units' => $units,
                    'exclude' => 'hourly,daily'
                ]);
                if ($response->successful()) {
                    $currentWeatherData = $response->json();
                    return view('home', compact('currentWeatherData'));
                } else {
                    return view('home')->with('error', 'Failed to retrieve weather data');
                }
            case 'searchNextTwentyFourHours':
                if ($data) {
                    $loc = $data;
                } else {
                    $loc = "Hyderabad";
                }
                $response = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
                    'q' => $loc,
                    'APPID' => env('OPENWEATHER_API_KEY'),
                    'units' => $units,
                    'exclude' => 'current,minutely,daily'
                ]);
                if ($response->successful()) {
                    $data = json_decode($response->getBody(), true);
                    $hourlyForecast = [];
                    $currentTime = time();
                    $next24Hours = strtotime('+24 hours', $currentTime);
                    foreach ($data['list'] as $item) {
                        $timestamp = strtotime($item['dt_txt']);
                        if ($timestamp >= $currentTime && $timestamp <= $next24Hours && count($hourlyForecast) < 24) {
                            $hourlyForecast[] = $item;
                        }
                    }
                    return view('home', compact('hourlyForecast'));
                } else {
                    return view('home')->with('error', 'Failed to retrieve weather data');
                }
            case 'searchNextWeek':
                if ($data) {
                    $loc = $data;
                } else {
                    $loc = "Hyderabad";
                }
                $response = Http::get('https://api.openweathermap.org/data/2.5/forecast/daily', [
                    'q' => $loc,
                    'APPID' => env('OPENWEATHER_API_KEY'),
                    'units' => $units,
                    'cnt' => 7
                ]);
                if ($response->successful()) {
                    $nextWeekWeatherData = $response->json();
                    return view('home', compact('nextWeekWeatherData'));
                } else {
                    return view('home')->with('error', 'Failed to retrieve weather data');
                }
            default:
                return view('home')->with('error', 'Invalid link selected');
        }
    }
}
