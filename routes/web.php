<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\WeatherController@getSearchCurrent')->name('home');
Route::post('/send-data', 'App\Http\Controllers\WeatherController@sendData')->name('sendData');
Route::post('/search-current/{location?}', 'App\Http\Controllers\WeatherController@searchCurrent')->name('searchCurrent');
Route::post('/search-next-twenty-four-hours/{location?}', 'App\Http\Controllers\WeatherController@searchNextTwentyFourHours')->name('searchNextTwentyFourHours');
Route::post('/search-next-week/{location?}', 'App\Http\Controllers\WeatherController@searchNextWeek')->name('searchNextWeek');
