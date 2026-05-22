@php
    /** @var string $currentRoute */
    $currentRoute = Route::currentRouteName() ?? '';

    /** @var list<array{label:string,route:string}> $items */
    $items = [
        ['label' => 'Domů', 'route' => 'climbing.home'],
        ['label' => 'O stěně', 'route' => 'climbing.about'],
        ['label' => 'Ceník', 'route' => 'climbing.pricing'],
        ['label' => 'Kroužky a oddíl', 'route' => 'climbing.programs'],
        ['label' => 'Aktuality', 'route' => 'climbing.news.index'],
        ['label' => 'Kontakt', 'route' => 'climbing.contact'],
    ];
@endphp

<nav
    x-data="{ open: false }"
    class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-border shadow-subtle"
>
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('climbing.home') }}" class="flex items-center space-x-3">
                <img src="/images/site/logo.png" alt="Lezecká stěna – František Rys" class="h-10 w-auto">
                <span class="hidden sm:inline text-industrial-dark font-bold tracking-wide">Lezecká stěna</span>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                @foreach ($items as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        @class([
                            'transition-colors font-medium',
                            'text-primary' => $currentRoute === $item['route'],
                            'text-industrial-dark hover:text-primary' => $currentRoute !== $item['route'],
                        ])
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="hidden md:flex items-center space-x-3">
                <a href="{{ route('climbing.contact') }}"
                   class="inline-flex items-center px-3 py-2 text-sm bg-gradient-primary text-white rounded-md hover:opacity-90 transition-opacity shadow-red">
                    Přijeďte k nám
                </a>
                <a href="{{ url('/') }}"
                   class="inline-flex items-center px-3 py-2 text-sm border border-industrial-medium text-industrial-medium rounded-md hover:bg-industrial-dark hover:text-white hover:border-industrial-dark transition-colors">
                    Výškové práce
                </a>
            </div>

            <button
                type="button"
                class="md:hidden p-2 text-industrial-dark hover:text-primary"
                @click="open = !open"
                :aria-expanded="open"
                aria-label="Menu"
            >
                <svg x-show="!open" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
                <svg x-show="open" x-cloak class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M6 18L18 6"/></svg>
            </button>
        </div>

        <div x-show="open" x-cloak class="md:hidden py-4 border-t border-border bg-white">
            <div class="flex flex-col space-y-2">
                @foreach ($items as $item)
                    <a
                        @click="open = false"
                        href="{{ route($item['route']) }}"
                        @class([
                            'px-4 py-2 font-medium',
                            'text-primary' => $currentRoute === $item['route'],
                            'text-industrial-dark hover:text-primary' => $currentRoute !== $item['route'],
                        ])
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
                <div class="flex flex-col space-y-2 px-4 pt-4 border-t border-border">
                    <a @click="open = false" href="{{ route('climbing.contact') }}" class="inline-flex items-center px-3 py-2 text-sm bg-gradient-primary text-white rounded-md">Přijeďte k nám</a>
                    <a href="{{ url('/') }}" class="inline-flex items-center px-3 py-2 text-sm border border-industrial-medium text-industrial-medium rounded-md">Výškové práce</a>
                </div>
            </div>
        </div>
    </div>
</nav>
