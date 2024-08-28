<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Backend Service</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <style>
        body {
            padding-top: 56px;
        }
        #sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background-color: #343a40;
            color: #fff;
        }
        #sidebar .sidebar-header {
            padding: 15px;
            background: #495057;
        }
        #sidebar .sidebar-header h3 {
            margin: 0;
            color: #fff;
        }
        #sidebar ul {
            padding: 0;
            list-style: none;
        }
        #sidebar ul li {
            padding: 10px;
        }
        #sidebar ul li a {
            color: #ddd;
            text-decoration: none;
        }
        #sidebar ul li a.active {
            color: #fff;
            background: #007bff;
        }
        #content {
            margin-left: 250px; /* Sidebar width */
            padding: 20px;
        }
        footer {
            bottom: 0;
            width: 100%;
            background: white;
            color: turquoise;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Bank DKI</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                @guest
                @else
                <li class="{{ request()->routeIs('rekening.index') ? 'active' : '' }}">
                    <a href="{{ route('rekening.index') }}">Rekening</a>
                </li>
                @endguest
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <a class="navbar-brand" href="#">Bank Backend Service</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Profile</a>
                                    <a class="dropdown-item" href="#">Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>

            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} MyAPP. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>
