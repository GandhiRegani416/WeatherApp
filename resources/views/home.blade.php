<!DOCTYPE html>
<html>
<head>
    <title>Weather Forecast App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0 auto;
            
        }
    </style>
</head>
<body>
    <div class="center-container">
        <div class="container">
            <form method="POST" action="{{ route('sendData') }}">
                
                @csrf
                <div class="input-group mb-1">
                    <label for="location" class="display-5">Enter Location</h1><br>
                    <input type="text" class="form-control" name="data" id="location" placeholder="Enter data"><br><br>
                </div>
            
                @if (!empty($hourlyForecast))
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Hour</th>
                                <th>Weather</th>
                                <th>Temp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hourlyForecast as $data)
                                <tr>
                                    <td>
                                        @php
                                            $date = $data['dt_txt'];
                                            $dateTime = new DateTime($date);
                                            $twelveHourFormat = $dateTime->format('g:i A');
                                            echo $twelveHourFormat;
                                        @endphp
                                    </td>
                                    <td>{{ $data['weather'][0]['main'] }}</td>
                                    <td>{{ floor($data['main']['temp']) }}<sup>0</sup> C</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif (!empty($nextWeekWeatherData))
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Hour</th>
                                <th>Weather</th>
                                <th>Temp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nextWeekWeatherData as $data)
                                <td>
                                    @php
                                        $date = $data['dt_txt'];
                                        $dateTime = new DateTime($date);
                                        $Format = strtotime($dateTime);
                                        echo $Format;
                                    @endphp 
                                </td>
                                <td>{{ $data['weather'][0]['main'] }}</td>
                                <td>{{ floor($data['main']['temp']) }}<sup>0</sup> C</td>
                            @endforeach
                        </tbody>
                    </table>
                @elseif (!empty($currentWeatherData))
                    <h5>Current Weather Description: {{ $currentWeatherData['weather'][0]['main'] }}</h3>
                    <h5>Current temp: {{ $currentWeatherData['main']['temp'] }}</h5>
                    <h5>Feels like: {{ $currentWeatherData['main']['feels_like'] }}</h5>
                    <h5>Humidity: {{ $currentWeatherData['main']['humidity'] }}</h5>
                @else
                    @if (isset($error))
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endif
                @endif
                <button type="submit" name="link" class="btn btn-link" value="searchCurrent">Current Weather</button>
                <button type="submit" name="link" class="btn btn-link" value="searchNextTwentyFourHours">Next 24 Hours</button>
                <button type="submit" name="link" class="btn btn-link" value="searchNextWeek">Next 7 Days</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
