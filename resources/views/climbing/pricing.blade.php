@php
    /** @var array<string, list<\App\Models\ClimbingPrice>> $grouped */
    $title = 'Ceník – Lezecká stěna';
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <section class="bg-gradient-industrial text-white py-20">
        <div class="container mx-auto px-4">
            <p class="text-sm text-industrial-light mb-3">
                <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                <span class="mx-2 text-industrial-medium">»</span>
                <span>Ceník</span>
            </p>
            <h1 class="text-4xl md:text-6xl font-bold">Ceník</h1>
            <p class="text-xl text-industrial-light mt-4 max-w-2xl">
                Vstupné, permanentky a tréninky. Platby v hotovosti i kartou.
            </p>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-4">
            @if (empty($grouped))
                <p class="text-center text-muted-foreground">
                    Ceník bude brzy zveřejněn. Kontaktujte nás pro aktuální ceny.
                </p>
            @else
                <div class="space-y-16 max-w-5xl mx-auto">
                    @foreach ($grouped as $category => $rows)
                        <div>
                            <h2 class="text-3xl md:text-4xl font-bold text-industrial-dark mb-8 border-l-4 border-primary pl-4">
                                {{ $category }}
                            </h2>

                            <div class="rounded-lg shadow-subtle bg-white divide-y divide-border">
                                @foreach ($rows as $row)
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-6 px-6 py-5">
                                        <div class="min-w-0 flex-1">
                                            <div class="font-medium text-industrial-dark">{{ $row->name }}</div>
                                            @if ($row->description)
                                                <p class="text-sm text-muted-foreground mt-1">{{ $row->description }}</p>
                                            @endif
                                        </div>
                                        <div class="sm:text-right sm:flex-shrink-0">
                                            <span class="text-2xl font-bold text-primary">{{ $row->price }}</span>
                                            @if ($row->unit)
                                                <span class="block text-xs text-muted-foreground">{{ $row->unit }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <p class="text-center text-sm text-muted-foreground mt-12 max-w-2xl mx-auto">
                Uvedené ceny jsou včetně DPH. Pro skupinové akce a firemní teambuildingy
                připravíme individuální nabídku – ozvěte se nám na
                <a href="{{ route('climbing.contact') }}" class="text-primary hover:text-primary-hover">kontaktní stránce</a>.
            </p>
        </div>
    </section>

    @include('climbing.partials.cta')
@endsection
