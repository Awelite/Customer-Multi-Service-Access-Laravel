<!DOCTYPE html>
<html>
<head>
    <title>Provider Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-light text-dark">
    @include('provider.navbar')

    <div class="container py-4">
        @yield('content')
    </div>
</body>
</html>
