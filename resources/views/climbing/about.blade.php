@php
    $title = 'O stěně – Lezecká stěna';

    /** @var list<array{name:string,role:string,bio:string}> $team */
    $team = [
        [
            'name' => 'František Rys',
            'role' => 'Hlavní trenér',
            'bio' => 'Historicky první reprezentant ČR v paralezení, první medailista z mezinárodní soutěže (3. místo z ME ve Villars).',
        ],
    ];

    /** @var list<array{label:string,value:string}> $parameters */
    $parameters = [
        ['label' => 'Obtížnost', 'value' => '4 – 9 UIAA'],
        ['label' => 'Maximální výška', 'value' => '12 metrů'],
        ['label' => 'Počet cest', 'value' => 'přes 100'],
        ['label' => 'Celková plocha', 'value' => '400 m²'],
    ];

    /** @var list<string> $equipment */
    $equipment = [
        'Automatická jištění (automat)',
        'Půjčovna výstroje',
        'Šatny a sprchy',
        'Klimatizace',
    ];
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <section class="pt-16 pb-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <p class="text-sm text-muted-foreground mb-3">
                <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                <span class="mx-2 text-industrial-light">»</span>
                <span class="text-industrial-dark">O stěně</span>
            </p>
            <h1 class="text-4xl md:text-5xl font-bold text-industrial-dark">Náš příběh</h1>
        </div>
    </section>

    <section class="pb-20">
        <div class="container mx-auto px-4 max-w-4xl">
            <p class="text-lg text-industrial-medium leading-relaxed mb-6">
                Lezecká stěna vznikla z lásky k lezení a touhy nabídnout dětem
                i dospělým prostor, kde si můžou vyzkoušet něco nového, posunout
                své hranice a najít komunitu lidí se stejným nadšením.
            </p>
            <p class="text-lg text-industrial-medium leading-relaxed">
                Provozuje ji <a href="{{ url('/') }}" class="text-primary hover:text-primary-hover font-medium">František Rys – Výškové práce</a>,
                takže za vším stojí roky zkušeností s prací ve výškách,
                důraz na bezpečnost a profesionalitu.
            </p>
        </div>
    </section>

    <section class="py-20 bg-gradient-subtle">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-industrial-dark mb-6">Náš tým</h2>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                    Jsme tým nadšenců, co dělá práci srdcem.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                @foreach ($team as $member)
                    <article class="bg-white rounded-lg shadow-subtle p-8 text-center">
                        <div class="mx-auto h-32 w-32 rounded-full bg-gradient-industrial mb-6 flex items-center justify-center text-white text-3xl font-bold">
                            {{ collect(explode(' ', $member['name']))->map(fn (string $part) => mb_substr($part, 0, 1))->implode('') }}
                        </div>
                        <h3 class="text-2xl font-bold text-industrial-dark mb-1">{{ $member['name'] }}</h3>
                        <p class="text-primary font-medium mb-4">{{ $member['role'] }}</p>
                        <p class="text-muted-foreground leading-relaxed">{{ $member['bio'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-industrial-dark mb-6">Technické informace</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <div class="bg-white rounded-lg shadow-subtle p-8">
                    <h3 class="text-xl font-bold text-industrial-dark mb-6">Parametry stěny</h3>
                    <ul class="space-y-3">
                        @foreach ($parameters as $param)
                            <li class="flex items-center justify-between border-b border-border pb-2 last:border-b-0">
                                <span class="text-muted-foreground">{{ $param['label'] }}</span>
                                <span class="font-medium text-industrial-dark">{{ $param['value'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white rounded-lg shadow-subtle p-8">
                    <h3 class="text-xl font-bold text-industrial-dark mb-6">Vybavení</h3>
                    <ul class="space-y-3">
                        @foreach ($equipment as $item)
                            <li class="flex items-center text-industrial-medium">
                                <span class="w-2 h-2 bg-primary rounded-full mr-3"></span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @include('climbing.partials.cta')
@endsection
