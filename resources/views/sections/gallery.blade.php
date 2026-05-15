<section id="galerie" class="py-20 bg-gradient-subtle">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-industrial-dark mb-6">Galerie z mé práce</h2>
            <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                Podívejte se na fotografie a videa z různých typů výškových prací.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="media-gallery">
                @foreach ($mediaItems as $item)
                    @if ($item->isVideo())
                        @php
                            $videoData = json_encode([
                                'source' => [['src' => $item->streamUrl(), 'type' => $item->mimeType()]],
                                'attributes' => ['preload' => 'metadata', 'controls' => true, 'playsinline' => true],
                            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_AMP);
                        @endphp
                        <a
                            href="{{ $item->streamUrl() }}"
                            data-video='{!! $videoData !!}'
                            @if ($item->posterUrl())
                                data-poster="{{ $item->posterUrl() }}"
                            @endif
                            data-sub-html="<h4>{{ e($item->title) }}</h4><p>{{ e($item->description) }}</p>"
                            class="block group rounded-lg overflow-hidden bg-white shadow-subtle hover:shadow-industrial hover:-translate-y-1 transition-all duration-300"
                        >
                            <div class="relative h-64 overflow-hidden bg-industrial-dark">
                                @if ($item->posterUrl())
                                    <img src="{{ $item->posterUrl() }}" alt="{{ $item->title }}" class="w-full h-full object-cover opacity-90" loading="lazy">
                                @else
                                    <video src="{{ $item->streamUrl() }}" class="w-full h-full object-cover" preload="metadata" muted playsinline></video>
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
                                @if ($item->duration)
                                    <div class="absolute bottom-4 right-4 bg-industrial-dark/80 text-white px-2 py-1 rounded text-sm">{{ $item->duration }}</div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-industrial-dark mb-2">{{ $item->title }}</h3>
                                @if ($item->description)
                                    <p class="text-sm text-muted-foreground">{{ $item->description }}</p>
                                @endif
                            </div>
                        </a>
                    @else
                        <a
                            href="{{ $item->fileUrl() }}"
                            data-sub-html="<h4>{{ e($item->title) }}</h4><p>{{ e($item->description) }}</p>"
                            class="block group rounded-lg overflow-hidden bg-white shadow-subtle hover:shadow-industrial hover:-translate-y-1 transition-all duration-300"
                        >
                            <div class="relative h-64 overflow-hidden">
                                <img
                                    src="{{ $item->fileUrl() }}"
                                    alt="{{ $item->title }}"
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
                                <h3 class="text-xl font-bold text-industrial-dark mb-2">{{ $item->title }}</h3>
                                @if ($item->description)
                                    <p class="text-sm text-muted-foreground">{{ $item->description }}</p>
                                @endif
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
    </div>
</section>
