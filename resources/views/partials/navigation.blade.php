<nav
    x-data="{ open: false }"
    class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-border shadow-subtle"
>
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <a href="#hero" class="flex items-center space-x-3">
                <img src="/images/site/logo.png" alt="František Rys – Výškové práce" class="h-10 w-auto">
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#hero" class="text-industrial-dark hover:text-primary transition-colors font-medium">Domů</a>
                <a href="#services" class="text-industrial-dark hover:text-primary transition-colors font-medium">Služby</a>
                @if (! empty($projects) && $projects->isNotEmpty())
                    <a href="#gallery" class="text-industrial-dark hover:text-primary transition-colors font-medium">Reference</a>
                @endif
                @if (! empty($mediaItems) && $mediaItems->isNotEmpty())
                    <a href="#galerie" class="text-industrial-dark hover:text-primary transition-colors font-medium">Galerie</a>
                @endif
                <a href="#contact" class="text-industrial-dark hover:text-primary transition-colors font-medium">Kontakt</a>
            </div>

            <div class="hidden md:flex items-center space-x-3">
                <a href="#contact"
                   class="inline-flex items-center px-3 py-2 text-sm bg-gradient-primary text-white rounded-md hover:opacity-90 transition-opacity shadow-red">
                    Poptávka
                </a>
                <a href="tel:+420776089310"
                   class="inline-flex items-center px-3 py-2 text-sm border border-primary text-primary rounded-md hover:bg-primary hover:text-white transition-colors">
                    <svg class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92V21a1 1 0 0 1-1.09 1A19.86 19.86 0 0 1 2 4.09 1 1 0 0 1 3 3h4.09a1 1 0 0 1 1 .75l1 4a1 1 0 0 1-.27 1L7.21 10.79a16 16 0 0 0 6 6l2.05-2.05a1 1 0 0 1 1-.27l4 1a1 1 0 0 1 .75 1Z"/></svg>
                    Zavolat
                </a>
                <a href="{{ route('climbing.home') }}"
                   class="inline-flex items-center px-3 py-2 text-sm border border-industrial-dark text-industrial-dark rounded-md hover:bg-industrial-dark hover:text-white transition-colors">
                    Lezecká stěna
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
                <a @click="open = false" href="#hero" class="px-4 py-2 text-industrial-dark hover:text-primary font-medium">Domů</a>
                <a @click="open = false" href="#services" class="px-4 py-2 text-industrial-dark hover:text-primary font-medium">Služby</a>
                @if (! empty($projects) && $projects->isNotEmpty())
                    <a @click="open = false" href="#gallery" class="px-4 py-2 text-industrial-dark hover:text-primary font-medium">Reference</a>
                @endif
                @if (! empty($mediaItems) && $mediaItems->isNotEmpty())
                    <a @click="open = false" href="#galerie" class="px-4 py-2 text-industrial-dark hover:text-primary font-medium">Galerie</a>
                @endif
                <a @click="open = false" href="#contact" class="px-4 py-2 text-industrial-dark hover:text-primary font-medium">Kontakt</a>
                <div class="flex flex-col space-y-2 px-4 pt-4 border-t border-border">
                    <a @click="open = false" href="{{ route('climbing.home') }}" class="inline-flex items-center justify-center px-3 py-2 text-sm border border-industrial-dark text-industrial-dark rounded-md hover:bg-industrial-dark hover:text-white">Lezecká stěna</a>
                    <a href="tel:+420776089310" class="inline-flex items-center px-3 py-2 text-sm border border-primary text-primary rounded-md hover:bg-primary hover:text-white">Zavolat +420 776 089 310</a>
                    <a @click="open = false" href="#contact" class="inline-flex items-center px-3 py-2 text-sm bg-gradient-primary text-white rounded-md">Nezávazná poptávka</a>
                </div>
            </div>
        </div>
    </div>
</nav>
