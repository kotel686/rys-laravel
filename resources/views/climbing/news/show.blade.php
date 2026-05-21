@php
    /** @var \App\Models\ClimbingPost $post */
    /** @var \Illuminate\Support\Collection<int, \App\Models\ClimbingPost> $related */
    $title = $post->title . ' – Lezecká stěna';
    $publishedAt = $post->published_at ?? $post->created_at;
@endphp

@extends('climbing.layout', ['title' => $title])

@section('climbing-content')
    <div class="bg-gradient-subtle py-12 md:py-16">
        <div class="container mx-auto px-4">
            <p class="text-sm text-muted-foreground mb-6 max-w-4xl mx-auto">
                <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                <span class="mx-2 text-industrial-light">»</span>
                <a href="{{ route('climbing.news.index') }}" class="hover:text-primary transition-colors">Aktuality</a>
                <span class="mx-2 text-industrial-light">»</span>
                <span class="text-industrial-dark">{{ $post->title }}</span>
            </p>

            <article class="max-w-4xl mx-auto bg-white rounded-lg shadow-subtle overflow-hidden">
                @if ($post->imageUrl())
                    <img
                        src="{{ $post->imageUrl() }}"
                        alt="{{ $post->title }}"
                        class="block w-full max-h-[460px] object-cover"
                    >
                @endif

                <div class="p-6 md:p-10 lg:p-12">
                    <p class="text-xs uppercase tracking-widest text-primary mb-3 font-semibold">
                        {{ $publishedAt->translatedFormat('j. F Y') }}
                    </p>

                    <h1 class="text-3xl md:text-4xl font-bold text-industrial-dark leading-tight mb-8">
                        {{ $post->title }}
                    </h1>

                    <div class="article-content">
                        {!! $post->content !!}
                    </div>
                </div>
            </article>

            <div class="max-w-4xl mx-auto mt-8">
                <a href="{{ route('climbing.news.index') }}" class="inline-flex items-center text-primary hover:text-primary-hover font-medium">
                    <svg class="mr-1 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Zpět na aktuality
                </a>
            </div>

            @if ($related->isNotEmpty())
                <div class="max-w-6xl mx-auto mt-16">
                    <h2 class="text-2xl md:text-3xl font-bold text-industrial-dark mb-8 text-center">Další aktuality</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($related as $other)
                            <a href="{{ route('climbing.news.show', $other) }}" class="block bg-white rounded-lg overflow-hidden shadow-subtle hover:shadow-industrial hover:-translate-y-1 transition-all duration-300">
                                @if ($other->imageUrl())
                                    <div class="h-40 overflow-hidden">
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
            @endif
        </div>
    </div>

    @include('climbing.partials.cta')
@endsection
