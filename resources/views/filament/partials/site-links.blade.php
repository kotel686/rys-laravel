{{--
    Two pill-style buttons rendered into the Filament admin topbar via
    PanelsRenderHook::TOPBAR_END. Uses Filament's own button component
    so the styling matches the panel; the wrapper uses inline styles
    because our app's Tailwind classes aren't compiled into Filament's
    CSS bundle.
--}}
<div style="display: flex; gap: 0.5rem; align-items: center; margin-right: 0.75rem;">
    <x-filament::button
        tag="a"
        :href="url('/')"
        target="_blank"
        rel="noopener"
        color="gray"
        size="xs"
        icon="heroicon-o-arrow-top-right-on-square"
        icon-position="after"
    >
        Web Výškové práce
    </x-filament::button>

    <x-filament::button
        tag="a"
        :href="route('climbing.home')"
        target="_blank"
        rel="noopener"
        color="gray"
        size="xs"
        icon="heroicon-o-arrow-top-right-on-square"
        icon-position="after"
    >
        Web Lezecké stěny
    </x-filament::button>
</div>
