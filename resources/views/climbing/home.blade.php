@php
    /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClimbingProgram> $programs */
    $title = 'Lezecká stěna – Objevuj výšky s námi';

    /** @var list<array{title:string,description:string,icon:string}> $perks */
    $perks = [
        [
            'title' => 'Bezpečnost na prvním místě',
            'description' => 'Moderní bezpečnostní vybavení, certifikovaní trenéři a pravidelné kontroly.',
            'icon' => 'M12 2l8 4v6c0 5-3.5 9.5-8 10-4.5-.5-8-5-8-10V6l8-4z',
        ],
        [
            'title' => 'Zkušený tým',
            'description' => 'Trenéři s dlouholetými zkušenostmi a láskou k lezení.',
            'icon' => 'M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75',
        ],
        [
            'title' => 'Moderní vybavení',
            'description' => 'Stěna, která doslova voní novotou.',
            'icon' => 'M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z',
        ],
        [
            'title' => 'Rodinná atmosféra',
            'description' => 'Přátelské prostředí, kde se každý cítí jako doma.',
            'icon' => 'M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z',
        ],
    ];
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('/images/climbing/hero.png')">
            <div class="absolute inset-0 bg-industrial-dark/65"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 text-center text-white py-20">
            <div class="max-w-4xl mx-auto animate-fade-in">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    Objevuj výšky
                    <span class="block text-primary mt-2 drop-shadow-lg" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8)">s námi</span>
                </h1>

                <p class="text-xl md:text-2xl mb-8 text-industrial-light leading-relaxed">
                    Moderní lezecká stěna pro děti i dospělé. Profesionální trenéři,
                    přátelská atmosféra a bezpečné prostředí pro všechny věkové kategorie.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('climbing.contact') }}"
                       class="inline-flex items-center justify-center text-lg px-8 py-4 rounded-md bg-gradient-primary text-white shadow-red hover:opacity-90 transition-opacity">
                        Přijeďte k nám
                        <svg class="ml-2 h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('climbing.programs') }}"
                       class="inline-flex items-center justify-center text-lg px-8 py-4 rounded-md border-2 border-white bg-white text-industrial-dark hover:bg-white/90 transition-colors">
                        Prohlédnout kroužky
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if ($programs->isNotEmpty())
        <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-industrial-dark mb-6">Naše programy</h2>
                    <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                        Nabízíme širokou škálu programů pro všechny věkové kategorie a úrovně dovedností.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($programs as $program)
                        <article class="group rounded-lg bg-white overflow-hidden shadow-subtle hover:shadow-industrial hover:-translate-y-1 transition-all duration-300 p-8 text-center">
                            <div class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary mb-6 text-xl font-bold">
                                {{ $loop->iteration }}
                            </div>
                            <h3 class="text-2xl font-bold text-industrial-dark mb-3 uppercase tracking-wide">{{ $program->title }}</h3>
                            @if ($program->subtitle)
                                <p class="text-sm uppercase tracking-widest text-primary mb-3 font-semibold">{{ $program->subtitle }}</p>
                            @endif
                            <p class="text-muted-foreground mb-6 leading-relaxed">
                                {{ \Illuminate\Support\Str::limit($program->description, 160) }}
                            </p>
                            <a href="{{ route('climbing.programs') }}" class="inline-flex items-center text-primary hover:text-primary-hover font-medium">
                                Zjistit více
                                <svg class="ml-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-industrial-dark mb-6">Proč si vybrat naši stěnu?</h2>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                    Kombinujeme profesionalitu s přátelským přístupem.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($perks as $perk)
                    <div class="bg-white border border-border rounded-lg p-6 text-center shadow-subtle">
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-primary text-white mb-4">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="{{ $perk['icon'] }}"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-industrial-dark mb-2">{{ $perk['title'] }}</h3>
                        <p class="text-sm text-muted-foreground">{{ $perk['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('climbing.partials.cta')
@endsection
