{{--
    Two external "open the public site" buttons rendered into the
    Filament admin topbar via PanelsRenderHook::TOPBAR_END (registered
    in AdminPanelProvider). Hidden below md so the topbar doesn't get
    cramped on mobile – admin users can still hit /admin → resources
    and type the URL by hand if needed.
--}}
<div class="hidden md:flex items-center gap-2">
    <a
        href="{{ url('/') }}"
        target="_blank"
        rel="noopener"
        class="inline-flex items-center gap-1.5 rounded-md px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100 hover:text-primary-600 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-primary-400 transition"
    >
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 3h7v7M10 14L21 3M21 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6"/></svg>
        Web Výškové práce
    </a>

    <a
        href="{{ route('climbing.home') }}"
        target="_blank"
        rel="noopener"
        class="inline-flex items-center gap-1.5 rounded-md px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100 hover:text-primary-600 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-primary-400 transition"
    >
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 3h7v7M10 14L21 3M21 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6"/></svg>
        Web Lezecké stěny
    </a>
</div>
