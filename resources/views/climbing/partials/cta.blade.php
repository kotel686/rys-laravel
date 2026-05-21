<section class="py-20 bg-industrial-dark text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Připravte své dítě na dobrodružství</h2>
            <p class="text-lg text-industrial-light mb-10">
                Přihlaste své dítě do našeho kroužku a dejte mu příležitost objevovat svůj potenciál.
            </p>

            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left mb-10">
                @foreach ([
                    'Profesionální trenéři s certifikací',
                    'Bezpečné prostředí pro děti všech věkových kategorií',
                    'Moderní vybavení a automatická jištění',
                    'Přátelská atmosféra a rodinný přístup',
                ] as $perk)
                    <li class="flex items-start space-x-3 bg-white/5 backdrop-blur-sm rounded-md p-4 border border-white/10">
                        <span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-primary text-white flex-shrink-0">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg>
                        </span>
                        <span>{{ $perk }}</span>
                    </li>
                @endforeach
            </ul>

            <a
                href="{{ route('climbing.contact') }}"
                class="inline-flex items-center justify-center text-lg px-8 py-4 rounded-md bg-gradient-primary text-white shadow-red hover:opacity-90 transition-opacity"
            >
                Přihlásit dítě
                <svg class="ml-2 h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
