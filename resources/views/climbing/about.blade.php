@php
    /** @var string $story */
    /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClimbingTeamMember> $team */
    $title = 'O stěně – Lezecká stěna';

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
            <div class="article-content text-lg">
                {!! $story !!}
            </div>
        </div>
    </section>

    @if ($team->isNotEmpty())
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
                            @if ($member->imageUrl())
                                <img
                                    src="{{ $member->imageUrl() }}"
                                    alt="{{ $member->name }}"
                                    class="mx-auto h-32 w-32 rounded-full object-cover mb-6"
                                    loading="lazy"
                                >
                            @else
                                <div class="mx-auto h-32 w-32 rounded-full bg-gradient-industrial mb-6 flex items-center justify-center text-white text-3xl font-bold">
                                    {{ $member->initials() }}
                                </div>
                            @endif
                            <h3 class="text-2xl font-bold text-industrial-dark mb-1">{{ $member->name }}</h3>
                            @if ($member->role)
                                <p class="text-primary font-medium mb-4">{{ $member->role }}</p>
                            @endif
                            @if ($member->bio)
                                <p class="text-muted-foreground leading-relaxed">{{ $member->bio }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
