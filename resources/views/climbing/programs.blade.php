@php
    /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClimbingProgram> $programs */
    $title = 'Kroužky a oddíl – Lezecká stěna';
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <section class="pt-16 pb-12">
        <div class="container mx-auto px-4 max-w-5xl">
            <p class="text-sm text-muted-foreground mb-3">
                <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                <span class="mx-2 text-industrial-light">»</span>
                <span class="text-industrial-dark">Kroužky a oddíl</span>
            </p>
            <h1 class="text-4xl md:text-5xl font-bold text-industrial-dark">Kroužky a oddíl</h1>
            <p class="text-lg text-muted-foreground mt-4 max-w-2xl">
                Programy pro děti, hendikepované lezce i závodníky. Vyberte si, co Vám sedí.
            </p>
        </div>
    </section>

    <section class="pb-20">
        <div class="container mx-auto px-4">
            @if ($programs->isEmpty())
                <p class="text-center text-muted-foreground max-w-xl mx-auto">
                    Programy se chystají. Zatím se neváhejte zeptat přes
                    <a href="{{ route('climbing.contact') }}" class="text-primary hover:text-primary-hover">kontaktní stránku</a>.
                </p>
            @else
                <div class="space-y-12 max-w-5xl mx-auto">
                    @foreach ($programs as $i => $program)
                        <article class="bg-white rounded-lg shadow-subtle overflow-hidden md:flex">
                            <div class="md:w-1/3 bg-gradient-industrial text-white p-8 flex flex-col justify-center">
                                <span class="text-sm uppercase tracking-widest text-primary font-bold">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <h2 class="text-2xl md:text-3xl font-bold mt-2">{{ $program->title }}</h2>
                                @if ($program->subtitle)
                                    <p class="text-industrial-light mt-1">{{ $program->subtitle }}</p>
                                @endif
                            </div>
                            <div class="md:w-2/3 p-8">
                                <p class="text-industrial-medium leading-relaxed mb-6">{{ $program->description }}</p>

                                @php
                                    $bullets = collect($program->bullets ?? [])
                                        ->map(fn ($b) => is_array($b) ? ($b['text'] ?? null) : $b)
                                        ->filter()
                                        ->values();
                                @endphp

                                @if ($bullets->isNotEmpty())
                                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        @foreach ($bullets as $bullet)
                                            <li class="flex items-start text-sm text-industrial-dark">
                                                <span class="mt-1 mr-2 inline-flex h-4 w-4 items-center justify-center rounded-full bg-primary text-white flex-shrink-0">
                                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 13l4 4L19 7"/></svg>
                                                </span>
                                                {{ $bullet }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

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
            @endif
        </div>
    </section>

    @include('climbing.partials.cta')
@endsection
