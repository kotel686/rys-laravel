<section id="gallery" class="py-20 bg-background">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-industrial-dark mb-6">Moje reference</h2>
            <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                Podívejte se na vybrané projekty, které jsem úspěšně dokončil.
                Každá zakázka je pro mě výzvou k dokonalosti.
            </p>
        </div>

        @if ($projects->isEmpty())
            <p class="text-center text-muted-foreground">Brzy zde přibydou ukázky realizovaných projektů.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($projects as $project)
                    <article class="group rounded-lg overflow-hidden bg-white shadow-subtle hover:shadow-industrial hover:-translate-y-1 transition-all duration-300">
                        <div class="relative h-64 overflow-hidden">
                            <img
                                src="{{ $project->imageUrl() }}"
                                alt="{{ $project->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                loading="lazy"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-industrial-dark/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="text-xs text-industrial-light mb-1">
                                    {{ $project->year }}{{ $project->year && $project->location ? ' • ' : '' }}{{ $project->location }}
                                </div>
                                @if ($project->type)
                                    <div class="text-sm font-medium">{{ $project->type }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-industrial-dark mb-2">{{ $project->title }}</h3>
                            @if ($project->description)
                                <p class="text-sm text-muted-foreground mb-3">{{ $project->description }}</p>
                            @endif
                            <div class="flex justify-between items-center text-sm text-muted-foreground">
                                <span>{{ $project->location }}</span>
                                @if ($project->type)
                                    <span class="bg-primary/10 text-primary px-2 py-1 rounded-full text-xs">{{ $project->type }}</span>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
