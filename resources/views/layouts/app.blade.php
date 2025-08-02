<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #0d6efd;
            color: #fff;
            min-height: 100vh;
        }
        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 5px;
        }
        .sidebar .nav-link:hover {
            background-color: #0b5ed7;
        }
        .sidebar .nav-link.active {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
        }
        /* Header */
        header {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        body {
            background-color: #f8f9fa;
        }
    </style>

    @livewireStyles
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar p-3">
            <h5 class="fw-bold mb-4">Manajemen Sekolah</h5>
            <nav class="nav flex-column">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('kelas.index') }}" class="nav-link {{ request()->routeIs('kelas.index') ? 'active' : '' }}">Kelas</a>
                <a href="{{ route('siswa.index') }}" class="nav-link {{ request()->routeIs('siswa.index') ? 'active' : '' }}">Siswa</a>
                <a href="{{ route('guru.index') }}" class="nav-link {{ request()->routeIs('guru.index') ? 'active' : '' }}">Guru</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-grow-1">
            @include('layouts.navbar')

            @isset($header)
                <header>
                    <div class="container py-3">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="container py-4">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>
