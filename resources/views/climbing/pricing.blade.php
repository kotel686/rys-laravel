@php
    /** @var array<string, list<\App\Models\ClimbingPrice>> $grouped */
    /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClimbingPayment> $payments */
    $title = 'Ceník – Lezecká stěna';
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <section class="pt-16 pb-12">
        <div class="container mx-auto px-4 max-w-5xl">
            <p class="text-sm text-muted-foreground mb-3">
                <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                <span class="mx-2 text-industrial-light">»</span>
                <span class="text-industrial-dark">Ceník</span>
            </p>
            <h1 class="text-4xl md:text-5xl font-bold text-industrial-dark">Ceník</h1>
            <p class="text-lg text-muted-foreground mt-4 max-w-2xl">
                Vstupné, permanentky a tréninky. Platby v hotovosti i kartou.
            </p>
        </div>
    </section>

    <section class="pb-20">
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
                Uvedené ceny jsou včetně DPH.
            </p>
        </div>
    </section>

    @if ($payments->isNotEmpty())
        <section class="pb-20">
            <div class="container mx-auto px-4">
                <div class="max-w-5xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-bold text-industrial-dark mb-8 border-l-4 border-primary pl-4">
                        Platba QR kódem
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($payments as $payment)
                            <div class="bg-white rounded-lg shadow-subtle p-6 flex flex-col">
                                <h3 class="text-lg font-bold text-industrial-dark mb-4 text-center">{{ $payment->title }}</h3>

                                <div class="bg-white border border-border rounded-md p-3 flex items-center justify-center mb-4">
                                    <img
                                        src="{{ $payment->imageUrl() }}"
                                        alt="QR kód – {{ $payment->title }}"
                                        class="block w-auto h-auto max-w-full max-h-64"
                                        loading="lazy"
                                    >
                                </div>

                                @if ($payment->description)
                                    <p class="text-sm text-muted-foreground whitespace-pre-line text-center">{{ $payment->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <p class="text-center text-xs text-muted-foreground mt-6">
                        Naskenujte QR kód v aplikaci své banky a potvrďte platbu.
                    </p>
                </div>
            </div>
        </section>
    @endif

    @include('climbing.partials.cta')
@endsection
