<section id="galerie" class="py-20 bg-gradient-subtle">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-industrial-dark mb-6">Galerie z mé práce</h2>
            <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                Podívejte se na fotografie a videa z různých typů výškových prací.
            </p>
        </div>

        @if ($photos->isEmpty() && $videos->isEmpty())
            <p class="text-center text-muted-foreground">Galerie je zatím prázdná, brzy se sem podíváme.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="media-gallery">
                @foreach ($photos as $photo)
                    <a
                        href="{{ $photo->imageUrl() }}"
                        data-sub-html="<h4>{{ e($photo->title) }}</h4><p>{{ e($photo->description) }}</p>"
                        class="block group rounded-lg overflow-hidden bg-white shadow-subtle hover:shadow-industrial hover:-translate-y-1 transition-all duration-300"
                    >
                        <div class="relative h-64 overflow-hidden">
                            <img
                                src="{{ $photo->imageUrl() }}"
                                alt="{{ $photo->title }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                            >
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-industrial-dark/80 text-white">
                                    <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="M21 15l-5-5L5 21"/></svg>
                                    Foto
                                </span>
                            </div>
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                                <span class="opacity-0 group-hover:opacity-100 transition-opacity bg-white/20 backdrop-blur-sm rounded-full p-3">
                                    <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="M21 15l-5-5L5 21"/></svg>
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-industrial-dark mb-2">{{ $photo->title }}</h3>
                            @if ($photo->description)
                                <p class="text-sm text-muted-foreground">{{ $photo->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach

                @foreach ($videos as $video)
                    <a
                        href="{{ $video->videoUrl() }}"
                        data-video='@json([
                            "source" => [["src" => $video->videoUrl(), "type" => "video/mp4"]],
                            "attributes" => ["preload" => "metadata", "controls" => true],
                        ])'
                        data-poster="{{ $video->posterUrl() }}"
                        data-sub-html="<h4>{{ e($video->title) }}</h4><p>{{ e($video->description) }}</p>"
                        class="block group rounded-lg overflow-hidden bg-white shadow-subtle hover:shadow-industrial hover:-translate-y-1 transition-all duration-300"
                    >
                        <div class="relative h-64 overflow-hidden bg-industrial-dark">
                            @if ($video->posterUrl())
                                <img src="{{ $video->posterUrl() }}" alt="{{ $video->title }}" class="w-full h-full object-cover opacity-90" loading="lazy">
                            @else
                                <video src="{{ $video->videoUrl() }}" class="w-full h-full object-cover" preload="metadata" muted></video>
                            @endif
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="bg-white/20 backdrop-blur-sm rounded-full p-4">
                                    <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                </span>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-industrial-dark/80 text-white">
                                    <svg class="w-3 h-3 mr-1" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                    Video
                                </span>
                            </div>
                            @if ($video->duration)
                                <div class="absolute bottom-4 right-4 bg-industrial-dark/80 text-white px-2 py-1 rounded text-sm">{{ $video->duration }}</div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-industrial-dark mb-2">{{ $video->title }}</h3>
                            @if ($video->description)
                                <p class="text-sm text-muted-foreground">{{ $video->description }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
