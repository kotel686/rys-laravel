@php
    /** @var \App\Models\ClimbingPost $post */
    /** @var \Illuminate\Support\Collection<int, \App\Models\ClimbingPost> $related */
    $title = $post->title . ' – Lezecká stěna';
    $publishedAt = $post->published_at ?? $post->created_at;
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <article>
        <header class="bg-white border-b border-border py-16">
            <div class="container mx-auto px-4 max-w-4xl">
                <p class="text-sm text-muted-foreground mb-3">
                    <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                    <span class="mx-2 text-industrial-light">»</span>
                    <a href="{{ route('climbing.news.index') }}" class="hover:text-primary transition-colors">Aktuality</a>
                    <span class="mx-2 text-industrial-light">»</span>
                    <span class="text-industrial-dark">{{ $post->title }}</span>
                </p>

                <p class="text-sm uppercase tracking-widest text-primary mb-3 font-semibold">
                    {{ $publishedAt->translatedFormat('j. F Y') }}
                </p>

                <h1 class="text-4xl md:text-5xl font-bold text-industrial-dark leading-tight">{{ $post->title }}</h1>

                @if ($post->excerpt)
                    <p class="text-xl text-muted-foreground mt-6 max-w-3xl leading-relaxed">
                        {{ $post->excerpt }}
                    </p>
                @endif
            </div>
        </header>

        @if ($post->imageUrl())
            <div class="bg-white py-10">
                <div class="container mx-auto px-4 max-w-4xl">
                    <img
                        src="{{ $post->imageUrl() }}"
                        alt="{{ $post->title }}"
                        class="mx-auto block w-auto h-auto max-h-[520px] max-w-full rounded-lg shadow-subtle"
                    >
                </div>
            </div>
        @endif

        <div class="pb-16 pt-4">
            <div class="container mx-auto px-4 max-w-3xl">
                <div class="article-content">
                    {!! $post->content !!}
                </div>

                <div class="mt-12 pt-8 border-t border-border">
                    <a href="{{ route('climbing.news.index') }}" class="inline-flex items-center text-primary hover:text-primary-hover font-medium">
                        <svg class="mr-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Zpět na aktuality
                    </a>
                </div>
            </div>
        </div>
    </article>

    @if ($related->isNotEmpty())
        <section class="py-16 bg-white border-t border-border">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-industrial-dark mb-10 text-center">Další aktuality</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    @foreach ($related as $other)
                        <a href="{{ route('climbing.news.show', $other) }}" class="block bg-white rounded-lg overflow-hidden border border-border hover:shadow-industrial hover:-translate-y-1 transition-all duration-300">
                            @if ($other->imageUrl())
                                <div class="h-40 overflow-hidden bg-white">
                                    <img
                                        src="{{ $other->imageUrl() }}"
                                        alt="{{ $other->title }}"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                </div>
                            @endif
                            <div class="p-5">
                                <p class="text-xs uppercase tracking-widest text-primary mb-2 font-semibold">
                                    {{ ($other->published_at ?? $other->created_at)->translatedFormat('j. F Y') }}
                                </p>
                                <h3 class="text-lg font-bold text-industrial-dark leading-tight">{{ $other->title }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('climbing.partials.cta')
@endsection
