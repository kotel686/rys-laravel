<!doctype html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'František Rys – Výškové práce' }}</title>
    <meta name="description" content="Profesionální výškové práce – nátěry fasád a střech, klempířství, štukatérství. Praha a okolí.">

    <link rel="icon" href="/favicon.ico">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-background text-foreground antialiased">
    {{ $slot ?? '' }}
    @yield('content')
</body>
</html>
