@php
    $title = 'Kroužky a oddíl – Lezecká stěna';

    /** @var list<array{title:string,subtitle:string,description:string,bullets:list<string>}> $programs */
    $programs = [
        [
            'title' => 'Dětské tréninky',
            'subtitle' => 'Pravidelné lezecké kroužky',
            'description' => 'Pravidelné lezecké kroužky pro děti všech věkových kategorií. Zábavné učení základů lezení v bezpečném prostředí pod dohledem zkušených trenérů.',
            'bullets' => [
                'Děti od 6 do 15 let',
                'Skupiny rozdělené podle věku a úrovně',
                'Důraz na bezpečnost a správnou techniku',
                '1× nebo 2× týdně',
            ],
        ],
        [
            'title' => 'Tréninky hendikepovaných',
            'subtitle' => 'Lezení pro každého',
            'description' => 'Pravidelné lezecké tréninky uzpůsobené potřebám lezců s hendikepem. Individuální přístup, vyškolení trenéři a speciální vybavení.',
            'bullets' => [
                'Individuální plán a tempo',
                'Trenéři s praxí v paralezení',
                'Bezbariérový přístup ke stěně',
                'Možnost asistence',
            ],
        ],
        [
            'title' => 'Lezecký oddíl',
            'subtitle' => 'Závodní příprava',
            'description' => 'Závodní příprava pro talentované lezce. Systematický tréninkový program, účast na soutěžích a podpora cesty k reprezentaci.',
            'bullets' => [
                'Výběrové tréninky pro pokročilé',
                'Soutěžní příprava (obtížnost, bouldering)',
                'Systematická roční periodizace',
                'Doprovod na závody',
            ],
        ],
    ];
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <section class="bg-gradient-industrial text-white py-20">
        <div class="container mx-auto px-4">
            <p class="text-sm text-industrial-light mb-3">
                <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                <span class="mx-2 text-industrial-medium">»</span>
                <span>Kroužky a oddíl</span>
            </p>
            <h1 class="text-4xl md:text-6xl font-bold">Kroužky a oddíl</h1>
            <p class="text-xl text-industrial-light mt-4 max-w-2xl">
                Programy pro děti, hendikepované lezce i závodníky. Vyberte si, co Vám sedí.
            </p>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="space-y-12 max-w-5xl mx-auto">
                @foreach ($programs as $i => $program)
                    <article class="bg-white rounded-lg shadow-subtle overflow-hidden md:flex">
                        <div class="md:w-1/3 bg-gradient-industrial text-white p-8 flex flex-col justify-center">
                            <span class="text-sm uppercase tracking-widest text-primary font-bold">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <h2 class="text-2xl md:text-3xl font-bold mt-2">{{ $program['title'] }}</h2>
                            <p class="text-industrial-light mt-1">{{ $program['subtitle'] }}</p>
                        </div>
                        <div class="md:w-2/3 p-8">
                            <p class="text-industrial-medium leading-relaxed mb-6">{{ $program['description'] }}</p>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach ($program['bullets'] as $bullet)
                                    <li class="flex items-start text-sm text-industrial-dark">
                                        <span class="mt-1 mr-2 inline-flex h-4 w-4 items-center justify-center rounded-full bg-primary text-white flex-shrink-0">
                                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg>
                                        </span>
                                        {{ $bullet }}
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-6">
                                <a href="{{ route('climbing.contact') }}" class="inline-flex items-center text-primary hover:text-primary-hover font-medium">
                                    Přihlásit se
                                    <svg class="ml-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @include('climbing.partials.cta')
@endsection
