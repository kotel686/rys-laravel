<section id="climbing" class="py-20 bg-industrial-dark text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-industrial opacity-90"></div>

    <div class="relative z-10 container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
            <div>
                <span class="inline-block px-3 py-1 text-xs uppercase tracking-widest bg-primary/20 text-primary rounded-full mb-4">
                    Novinka
                </span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Lezecká stěna
                    <span class="block text-primary mt-2">pro děti i dospělé</span>
                </h2>
                <p class="text-lg text-industrial-light mb-6 leading-relaxed">
                    Kromě výškových prací provozujeme i moderní lezeckou stěnu.
                    Nabízíme dětské kroužky, tréninky hendikepovaných, závodní oddíl
                    a volné vstupy pro veřejnost.
                </p>

                <ul class="space-y-2 text-industrial-light mb-8">
                    @foreach ([
                        '12 metrů vysoká stěna, přes 100 cest',
                        'Automatická jištění a půjčovna výstroje',
                        'Trenéři s dlouholetou praxí',
                        'Po – Pá 14:00 – 21:00, So – Ne 10:00 – 20:00',
                    ] as $bullet)
                        <li class="flex items-start">
                            <span class="mt-1 mr-3 inline-flex h-5 w-5 items-center justify-center rounded-full bg-primary text-white flex-shrink-0">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg>
                            </span>
                            {{ $bullet }}
                        </li>
                    @endforeach
                </ul>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('climbing.home') }}"
                       class="inline-flex items-center px-5 py-3 rounded-md bg-gradient-primary text-white shadow-red hover:opacity-90 transition-opacity">
                        Otevřít web stěny
                        <svg class="ml-2 h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('climbing.about') }}"
                       class="inline-flex items-center px-5 py-3 rounded-md border border-white/40 text-white hover:bg-white/10 transition-colors">
                        O stěně
                    </a>
                    <a href="{{ route('climbing.pricing') }}"
                       class="inline-flex items-center px-5 py-3 rounded-md border border-white/40 text-white hover:bg-white/10 transition-colors">
                        Ceník
                    </a>
                    <a href="{{ route('climbing.programs') }}"
                       class="inline-flex items-center px-5 py-3 rounded-md border border-white/40 text-white hover:bg-white/10 transition-colors">
                        Kroužky
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/5 backdrop-blur-sm rounded-lg p-6 border border-white/10 text-center">
                    <div class="text-3xl font-bold text-primary mb-1">12 m</div>
                    <div class="text-sm text-industrial-light">Výška stěny</div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm rounded-lg p-6 border border-white/10 text-center">
                    <div class="text-3xl font-bold text-primary mb-1">100+</div>
                    <div class="text-sm text-industrial-light">Cest</div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm rounded-lg p-6 border border-white/10 text-center">
                    <div class="text-3xl font-bold text-primary mb-1">400 m²</div>
                    <div class="text-sm text-industrial-light">Plocha</div>
                </div>
                <div class="bg-white/5 backdrop-blur-sm rounded-lg p-6 border border-white/10 text-center">
                    <div class="text-3xl font-bold text-primary mb-1">4–9</div>
                    <div class="text-sm text-industrial-light">UIAA obtížnost</div>
                </div>
            </div>
        </div>
    </div>
</section>
