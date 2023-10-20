<!DOCTYPE html>
<html>
<head>
    <title>Search for Weather</title>
</head>
<body>
    <h1>Search for Weather</h1>
    <form method="post" action="{{ route('weather') }}">
        @csrf
        <input type="text" name="location" placeholder="Enter a location">
        <button type="submit">Get Weather</button>
    </form>
</body>
</html>
