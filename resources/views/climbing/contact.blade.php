@php
    $title = 'Kontakt – Lezecká stěna';
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <section class="pt-16 pb-12">
        <div class="container mx-auto px-4 max-w-5xl">
            <p class="text-sm text-muted-foreground mb-3">
                <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                <span class="mx-2 text-industrial-light">»</span>
                <span class="text-industrial-dark">Kontakt</span>
            </p>
            <h1 class="text-4xl md:text-5xl font-bold text-industrial-dark">Kontakt</h1>
            <p class="text-lg text-muted-foreground mt-4 max-w-2xl">
                Přijeďte k nám nebo nám napište. Rádi Vám zodpovíme dotazy ohledně
                lezení, kroužků i přihlášek.
            </p>
        </div>
    </section>

    <section class="pb-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <div class="bg-white rounded-lg shadow-subtle p-6">
                    <div class="flex items-start space-x-4">
                        <div class="bg-primary p-3 rounded-full text-white">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-industrial-dark text-lg mb-2">Adresa</h3>
                            <p class="text-muted-foreground">
                                Višňová 308<br>
                                262 61 Višňová<br>
                                Středočeský kraj, Česko
                            </p>
                            <a
                                href="https://mapy.com/s/nubadevadu"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex items-center mt-3 text-sm font-medium text-primary hover:text-primary-hover transition-colors"
                            >
                                Naplánovat trasu
                                <svg class="ml-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
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
                            <a href="mailto:franta.rys@gmail.com" class="text-muted-foreground hover:text-primary transition-colors font-medium">franta.rys@gmail.com</a>
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
                            @php
                                $openingHours = \App\Models\ClimbingOpeningHour::forDisplay();
                            @endphp
                            @forelse ($openingHours as $row)
                                <p class="text-muted-foreground">{{ $row->day_label }}: {{ $row->hours }}</p>
                            @empty
                                <p class="text-muted-foreground">Otevírací doba bude brzy zveřejněna.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-5xl mx-auto mt-12 bg-white rounded-lg shadow-subtle overflow-hidden">
                <iframe
                    src="https://mapy.com/s/nubadevadu"
                    title="Mapa – Višňová 308"
                    class="w-full h-[400px] block"
                    style="border: 0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>

            <div id="kontakt-formular" class="max-w-3xl mx-auto mt-16 bg-white rounded-lg shadow-subtle p-8 scroll-mt-24">
                <h3 class="text-2xl font-bold text-industrial-dark mb-6">Napište nám</h3>

                @if (session('contact_success'))
                    <div role="status" class="mb-4 rounded-md bg-green-50 border border-green-200 text-green-800 px-4 py-3">
                        {{ session('contact_success') }}
                    </div>
                @endif

                @if (session('contact_error'))
                    <div role="alert" class="mb-4 rounded-md bg-red-50 border border-red-200 text-red-800 px-4 py-3">
                        {{ session('contact_error') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-4" novalidate>
                    @csrf
                    <input type="hidden" name="source" value="lezeckastena">

                    <div class="hidden" aria-hidden="true">
                        <label>Webová stránka<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="climb-contact-name" class="block text-sm font-medium text-industrial-dark mb-1">Jméno a příjmení *</label>
                            <input
                                id="climb-contact-name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                maxlength="120"
                                autocomplete="name"
                                class="w-full rounded-md border border-input bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="climb-contact-email" class="block text-sm font-medium text-industrial-dark mb-1">E-mail *</label>
                            <input
                                id="climb-contact-email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                maxlength="190"
                                autocomplete="email"
                                class="w-full rounded-md border border-input bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                            >
                            @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="climb-contact-phone" class="block text-sm font-medium text-industrial-dark mb-1">Telefon</label>
                        <input
                            id="climb-contact-phone"
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            maxlength="32"
                            autocomplete="tel"
                            class="w-full rounded-md border border-input bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                        @error('phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="climb-contact-message" class="block text-sm font-medium text-industrial-dark mb-1">Zpráva *</label>
                        <textarea
                            id="climb-contact-message"
                            name="message"
                            rows="5"
                            required
                            minlength="10"
                            maxlength="5000"
                            class="w-full rounded-md border border-input bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                        >{{ old('message') }}</textarea>
                        @error('message') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <label class="flex items-start space-x-2 text-sm text-muted-foreground">
                        <input type="checkbox" name="consent" value="1" required class="mt-1">
                        <span>Souhlasím se zpracováním osobních údajů za účelem vyřízení poptávky.</span>
                    </label>
                    @error('consent') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror

                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-gradient-primary text-white font-medium shadow-red hover:opacity-90 transition-opacity">
                        Odeslat zprávu
                    </button>
                </form>
            </div>
        </div>
    </section>

    @include('climbing.partials.cta')
@endsection
