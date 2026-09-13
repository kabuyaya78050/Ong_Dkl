<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="ONG DKL - Parce que chaque enfant mérite une chance.">

    <title>
        @yield('title', 'ONG DKL')
    </title>

    <link rel="stylesheet"
          href="{{ asset('css/style.css') }}">
</head>

<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

</body>
</html>