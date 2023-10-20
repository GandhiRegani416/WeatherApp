<!DOCTYPE html>
<html>
<head>
    <title>Weather Forecast</title>
</head>
<body>
    <h1>Weather Forecast for {{ $weatherData['name'] }}, {{ $weatherData['sys']['country'] }}</h1>
    <p>Temperature: {{ $weatherData['main']['temp'] }} &#8451;</p>
    <p>Humidity: {{ $weatherData['main']['humidity'] }}%</p>
    <p>Weather: {{ $weatherData['weather'][0]['description'] }}</p>
    <a href="{{ route('search') }}">Search for Another Location</a>
</body>
</html>
