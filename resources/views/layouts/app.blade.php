<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Restoran Burger FJ')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --resto-dark: #1a1410;
            --resto-brown: #3e2723;
            --resto-brown-light: #5d4037;
            --resto-gold: #c9a227;
            --resto-gold-light: #e6c866;
            --resto-cream: #f7f2ea;
        }

        body {
            background-color: var(--resto-cream);
            font-family: 'Poppins', sans-serif;
            color: #2b2320;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .navbar-elegant {
            background: linear-gradient(180deg, var(--resto-dark), var(--resto-brown));
            border-bottom: 2px solid var(--resto-gold);
        }

        .navbar-elegant .navbar-brand {
            color: var(--resto-gold-light) !important;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .navbar-elegant .nav-link {
            color: #e8dfd1 !important;
            font-weight: 400;
        }

        .navbar-elegant .nav-link:hover {
            color: var(--resto-gold-light) !important;
        }

        /* Cards */
        .card {
            border: 1px solid rgba(201, 162, 39, 0.25);
            border-radius: 0.6rem;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--resto-brown);
            border-color: var(--resto-brown);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: var(--resto-dark);
            border-color: var(--resto-gold);
        }

        .btn-outline-primary {
            color: var(--resto-brown);
            border-color: var(--resto-brown);
        }

        .btn-outline-primary:hover {
            background-color: var(--resto-brown);
            border-color: var(--resto-brown);
        }

        /* Kartu dashboard bertema elegant */
        .card-elegant-1,
        .card-elegant-2,
        .card-elegant-3,
        .card-elegant-4,
        .card-elegant-5 {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .card-elegant-1:hover,
        .card-elegant-2:hover,
        .card-elegant-3:hover,
        .card-elegant-4:hover,
        .card-elegant-5:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .card-elegant-1 .btn,
        .card-elegant-2 .btn,
        .card-elegant-4 .btn,
        .card-elegant-5 .btn {
            background-color: var(--resto-gold-light);
            color: var(--resto-dark);
            border: none;
        }

        .card-elegant-3 .btn {
            background-color: var(--resto-gold-light);
            color: var(--resto-dark);
            border: none;
        }

        /* Hero section (landing page) */
        .hero-elegant {
            background-image: linear-gradient(rgba(26, 20, 16, 0.75), rgba(62, 39, 35, 0.85)),
            url("{{ asset('images/hero-bg.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 380px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        footer {
            border-top: 1px solid rgba(201, 162, 39, 0.3);
            color: #7a6f63 !important;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-elegant">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Restoran Burger FJ</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                @auth
                <ul class="navbar-nav me-auto ms-3">
                    @if (auth()->user()->role === 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.menu.index') }}">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.akun.index') }}">Verifikasi Akun</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.pesanan.index') }}">Verifikasi Pesanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.pembayaran.index') }}">Verifikasi Pembayaran</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.pengumuman.index') }}">Pengumuman</a></li>
                    @elseif (auth()->user()->status === 'accepted')
                    <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.menu.index') }}">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.pesanan.index') }}">Pesanan Saya</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.pengumuman.index') }}">Pengumuman</a></li>
                    @endif
                </ul>

                <div class="d-flex align-items-center">
                    <span class="text-white me-3">Halo,{{ auth()->user()->name }} </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                </div>
                @endauth

                @guest
                <ul class="navbar-nav me-auto ms-3">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                </ul>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-sm" style="background: var(--resto-gold-light); color: var(--resto-dark);">Daftar</a>
                </div>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>