@php
    $title = 'Kontakt – Lezecká stěna';
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <section class="bg-gradient-industrial text-white py-20">
        <div class="container mx-auto px-4">
            <p class="text-sm text-industrial-light mb-3">
                <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                <span class="mx-2 text-industrial-medium">»</span>
                <span>Kontakt</span>
            </p>
            <h1 class="text-4xl md:text-6xl font-bold">Kontakt</h1>
            <p class="text-xl text-industrial-light mt-4 max-w-2xl">
                Přijeďte k nám nebo nám napište. Rádi Vám zodpovíme dotazy ohledně
                lezení, kroužků i přihlášek.
            </p>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                <div class="bg-white rounded-lg shadow-subtle p-6">
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary p-3 rounded-full text-white">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-industrial-dark text-lg mb-2">Adresa</h3>
                            <p class="text-muted-foreground">Sportovní 123<br>150 00 Praha 5</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-subtle p-6">
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary p-3 rounded-full text-white">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92V21a1 1 0 0 1-1.09 1A19.86 19.86 0 0 1 2 4.09 1 1 0 0 1 3 3h4.09a1 1 0 0 1 1 .75l1 4a1 1 0 0 1-.27 1L7.21 10.79a16 16 0 0 0 6 6l2.05-2.05a1 1 0 0 1 1-.27l4 1a1 1 0 0 1 .75 1Z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-industrial-dark text-lg mb-2">Telefon</h3>
                            <a href="tel:+420776089310" class="text-muted-foreground hover:text-primary transition-colors font-medium">+420 776 089 310</a>
                            <p class="text-sm text-muted-foreground mt-1">Volejte v otevírací době.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-subtle p-6">
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary p-3 rounded-full text-white">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-industrial-dark text-lg mb-2">E-mail</h3>
                            <a href="mailto:info@lezeckastena.cz" class="text-muted-foreground hover:text-primary transition-colors font-medium">info@lezeckastena.cz</a>
                            <p class="text-sm text-muted-foreground mt-1">Odpovídáme do 24 hodin.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-subtle p-6">
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary p-3 rounded-full text-white">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-industrial-dark text-lg mb-2">Otevírací doba</h3>
                            <p class="text-muted-foreground">Po – Pá: 14:00 – 21:00</p>
                            <p class="text-muted-foreground">So – Ne: 10:00 – 20:00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-3xl mx-auto mt-16 bg-white rounded-lg shadow-subtle p-8 text-center">
                <h3 class="text-2xl font-bold text-industrial-dark mb-3">Napište nám</h3>
                <p class="text-muted-foreground mb-6">
                    Pro přihlášku do kroužku, dotazy nebo rezervaci využijte
                    kontaktní formulář na hlavním webu Výškové práce Rys.
                </p>
                <a href="{{ url('/') }}#contact" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-gradient-primary text-white font-medium shadow-red hover:opacity-90 transition-opacity">
                    Přejít na kontaktní formulář
                    <svg class="ml-2 h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    @include('climbing.partials.cta')
@endsection
