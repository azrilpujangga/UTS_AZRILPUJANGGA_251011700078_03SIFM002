<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Art Gallery')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <style>
        body {
            background-color: #f7f5f0;
            color: #292720;
            font-family: Georgia, 'Times New Roman', serif;
        }

        .navbar {
            background-color: #f7f5f0;
            border-bottom: 1px solid #dedbd3;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .nav-link {
            color: #292720;
            margin-left: 15px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #967348;
        }

        footer {
            background-color: #292720;
            color: #e9e3d8;
            padding: 25px 0;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container py-2">

            <a class="navbar-brand brand text-dark" href="{{ route('home') }}">
                ART GALLERY.
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                           href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('artworks.*') ? 'active' : '' }}"
                           href="{{ route('artworks.index') }}">
                            Gallery
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                           href="{{ route('about') }}">
                            About Us
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container d-flex flex-column flex-md-row
            justify-content-between gap-2">
            <span>ART GALLERY.</span>
            <span>&copy; {{ date('Y') }} Art Gallery. All rights reserved.</span>
        </div>
    </footer>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
