@extends('layouts.app', ['title' => $title ?? 'Lezecká stěna – František Rys'])

@section('content')
    @include('climbing.partials.navigation')

    <main class="pt-16">
        {{ $slot ?? '' }}
        @yield('climbing-content')
    </main>

    @include('climbing.partials.footer')
@endsection
