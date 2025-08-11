<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f0f2f5;
            color: #000;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 1rem;
        }
        .sidebar a {
            color: #fff;
            padding: 0.75rem 1rem;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            text-decoration: none;
        }
        .sidebar .active {
            background-color: #007bff;
        }
        .main-content {
            margin-left: 240px;
            padding: 2rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -240px;
                transition: all 0.3s ease;
            }
            .sidebar.show {
                left: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar position-fixed top-0 start-0 w-100 w-md-25 d-flex flex-column text-white">
        <div class="text-center fw-bold fs-4 pb-3 border-bottom border-secondary">Admin Panel</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.providers.index') }}" class="{{ request()->routeIs('admin.providers.*') ? 'active' : '' }}">Providers</a>
        <a href="{{ route('admin.services.index') }}" class="{{ request()->is('admin/services') ? 'active' : '' }}">
         <a href="{{ route('admin.requests.index') }}">Service Requests</a>
    All Services

</a>
<a href="{{ route('admin.services.create') }}" class="{{ request()->is('admin/services/create') ? 'active' : '' }}">
    ➕ Add Service
</a>

<a href="{{ route('admin.requests.index') }}" class="{{ request()->is('admin/service-requests') ? 'active' : '' }}">
    🧾 Service Requests
</a>

        <a href="#">Users</a>
        <a href="#">Settings</a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS (for responsiveness if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
