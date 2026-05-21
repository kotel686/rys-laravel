@php
    /** @var \Novius\LaravelFilamentNews\Models\NewsPost $post */
    /** @var \Illuminate\Support\Collection<int, \Novius\LaravelFilamentNews\Models\NewsPost> $related */
    $title = $post->seo_title ?: $post->title;
@endphp

@extends('climbing.layout', ['title' => $title . ' – Lezecká stěna'])

@section('climbing-content')
    <article>
        <header class="bg-gradient-industrial text-white py-20">
            <div class="container mx-auto px-4 max-w-4xl">
                <p class="text-sm text-industrial-light mb-3">
                    <a href="{{ route('climbing.home') }}" class="hover:text-primary transition-colors">Domů</a>
                    <span class="mx-2 text-industrial-medium">»</span>
                    <a href="{{ route('climbing.news.index') }}" class="hover:text-primary transition-colors">Aktuality</a>
                    <span class="mx-2 text-industrial-medium">»</span>
                    <span class="text-white">{{ $post->title }}</span>
                </p>

                @if ($post->published_at)
                    <p class="text-sm uppercase tracking-widest text-primary mb-3 font-semibold">
                        {{ $post->published_at->translatedFormat('j. F Y') }}
                    </p>
                @endif

                <h1 class="text-4xl md:text-5xl font-bold leading-tight">{{ $post->title }}</h1>

                @if ($post->intro)
                    <p class="text-xl text-industrial-light mt-6 max-w-3xl">
                        {{ strip_tags($post->intro) }}
                    </p>
                @endif
            </div>
        </header>

        @if ($post->featured_image)
            <div class="bg-industrial-dark">
                <div class="container mx-auto px-4 max-w-5xl">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($post->featured_image) }}"
                        alt="{{ $post->title }}"
                        class="w-full h-auto -mt-16 rounded-lg shadow-industrial relative z-10"
                    >
                </div>
            </div>
        @endif

        <div class="py-16">
            <div class="container mx-auto px-4 max-w-3xl">
                <div class="prose prose-lg max-w-none text-industrial-medium leading-relaxed">
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
        <section class="py-16 bg-gradient-subtle">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-industrial-dark mb-10 text-center">Další aktuality</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    @foreach ($related as $other)
                        <a href="{{ route('climbing.news.show', $other->slug) }}" class="block bg-white rounded-lg overflow-hidden shadow-subtle hover:shadow-industrial hover:-translate-y-1 transition-all duration-300">
                            @if ($other->card_image || $other->featured_image)
                                <div class="h-40 overflow-hidden">
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($other->card_image ?? $other->featured_image) }}"
                                        alt="{{ $other->title }}"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    >
                                </div>
                            @endif
                            <div class="p-5">
                                @if ($other->published_at)
                                    <p class="text-xs uppercase tracking-widest text-muted-foreground mb-2">
                                        {{ $other->published_at->translatedFormat('j. F Y') }}
                                    </p>
                                @endif
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
