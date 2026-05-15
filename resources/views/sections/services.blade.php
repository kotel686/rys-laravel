@php
    /** @var list<array{title:string,description:string,image:string,features:list<string>}> $services */
    $services = [
        [
            'title' => 'Nátěry fasád',
            'description' => 'Profesionální nátěry a renovace fasád všech typů budov. Používám kvalitní barvy a materiály pro dlouhodobou ochranu.',
            'image' => '/images/services/facade-painting.jpg',
            'features' => ['Příprava povrchu', 'Kvalitní barvy', 'Ochrana před povětrností', 'Záruka kvality'],
        ],
        [
            'title' => 'Nátěry střech',
            'description' => 'Ochranné nátěry střech prodlužující jejich životnost. Specializuji se na všechny typy střešních krytin.',
            'image' => '/images/services/roof-painting.jpg',
            'features' => ['Plechové střechy', 'Betonové tašky', 'Speciální nátěry', 'Protiskluzové úpravy'],
        ],
        [
            'title' => 'Klempířství',
            'description' => 'Kompletní klempířské práce včetně instalace a oprav okapových systémů, žlabů a dalších prvků.',
            'image' => '/images/services/plumbing-work.jpg',
            'features' => ['Okapové systémy', 'Oplechování', 'Svody', 'Opravy a údržba'],
        ],
        [
            'title' => 'Štukatérství',
            'description' => 'Tradiční štukatérské práce a dekorativní omítky. Renovace historických fasád i moderní designové řešení.',
            'image' => '/images/services/stucco-work.jpg',
            'features' => ['Dekorativní omítky', 'Renovace fasád', 'Historické prvky', 'Moderní design'],
        ],
    ];
@endphp

<section id="services" class="py-20 bg-gradient-subtle">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-industrial-dark mb-6">Moje služby</h2>
            <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                Nabízím kompletní spektrum výškových prací s důrazem na kvalitu,
                bezpečnost a spokojenost klientů.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ($services as $service)
                <article class="group rounded-lg bg-white overflow-hidden shadow-subtle hover:shadow-industrial hover:-translate-y-1 transition-all duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img
                            src="{{ $service['image'] }}"
                            alt="{{ $service['title'] }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            loading="lazy"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-industrial-dark/80 to-transparent"></div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-industrial-dark mb-3">{{ $service['title'] }}</h3>
                        <p class="text-muted-foreground mb-4 leading-relaxed">{{ $service['description'] }}</p>

                        <ul class="space-y-2">
                            @foreach ($service['features'] as $feature)
                                <li class="flex items-center text-sm text-industrial-medium">
                                    <span class="w-2 h-2 bg-primary rounded-full mr-3"></span>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
