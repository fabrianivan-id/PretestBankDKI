<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <!-- Navbar content -->
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <!-- Footer content -->
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
