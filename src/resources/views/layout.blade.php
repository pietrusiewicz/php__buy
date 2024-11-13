<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piłka na Warmii i Mazurach</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('okregowa') }}">Klasa Okręgowa</a></li>  
            <li><a href="{{ route('aklasa') }}">Klasa A</a></li>          
            <li><a href="{{ route('bklasa') }}">Klasa B</a></li>
            <li><a href="{{ route('gallery') }}">Galeria</a></li>
            <li><a href="{{ route('contact') }}">#zostansędzią</a></li>
        </ul>
    </nav>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>