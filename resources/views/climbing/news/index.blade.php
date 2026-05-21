@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator<\App\Models\ClimbingPost> $posts */
    $title = 'Aktuality – Lezecká stěna';
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <section class="pt-16 pb-12">
        <div class="container mx-auto px-4 max-w-6xl">
            <p class="text-sm text-muted-foreground mb-3">
                <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                <span class="mx-2 text-industrial-light">»</span>
                <span class="text-industrial-dark">Aktuality</span>
            </p>
            <h1 class="text-4xl md:text-5xl font-bold text-industrial-dark">Aktuality</h1>
            <p class="text-lg text-muted-foreground mt-4 max-w-2xl">
                Novinky ze stěny, závodní výsledky, nábory do kroužků a chystané akce.
            </p>
        </div>
    </section>

    <section class="pb-20">
        <div class="container mx-auto px-4">
            @if ($posts->isEmpty())
                <p class="text-center text-muted-foreground max-w-xl mx-auto">
                    Zatím tu žádné aktuality nemáme. Brzy přidáme první příspěvky –
                    sledujte tuto stránku.
                </p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    @foreach ($posts as $post)
                        <article class="bg-white rounded-lg overflow-hidden shadow-subtle hover:shadow-industrial hover:-translate-y-1 transition-all duration-300 flex flex-col">
                            @if ($post->imageUrl())
                                <a href="{{ route('climbing.news.show', $post) }}" class="block h-48 overflow-hidden">
                                    <img
                                        src="{{ $post->imageUrl() }}"
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                </a>
                            @else
                                <div class="h-48 bg-gradient-industrial flex items-center justify-center text-white/40">
                                    <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                                </div>
                            @endif

                            <div class="p-6 flex flex-col flex-1">
                                <p class="text-xs uppercase tracking-widest text-muted-foreground mb-2">
                                    {{ ($post->published_at ?? $post->created_at)->translatedFormat('j. F Y') }}
                                </p>

                                <h2 class="text-xl font-bold text-industrial-dark mb-3 leading-tight">
                                    <a href="{{ route('climbing.news.show', $post) }}" class="hover:text-primary transition-colors">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                @if ($post->excerpt)
                                    <p class="text-muted-foreground text-sm leading-relaxed mb-4 flex-1">
                                        {{ \Illuminate\Support\Str::limit($post->excerpt, 160) }}
                                    </p>
                                @endif

                                <a href="{{ route('climbing.news.show', $post) }}" class="inline-flex items-center text-primary hover:text-primary-hover font-medium mt-auto">
                                    Číst dále
                                    <svg class="ml-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12 max-w-6xl mx-auto">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>

    @include('climbing.partials.cta')
@endsection
