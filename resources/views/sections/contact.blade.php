<section id="contact" class="py-20 bg-gradient-subtle">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-industrial-dark mb-6">Kontakt</h2>
            <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                Kontaktujte nás pro nezávaznou konzultaci a cenovou nabídku.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto mb-12">
            <div class="bg-white rounded-lg shadow-subtle p-6">
                <div class="flex items-start space-x-4">
                    <div class="bg-primary p-3 rounded-full text-white">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92V21a1 1 0 0 1-1.09 1A19.86 19.86 0 0 1 2 4.09 1 1 0 0 1 3 3h4.09a1 1 0 0 1 1 .75l1 4a1 1 0 0 1-.27 1L7.21 10.79a16 16 0 0 0 6 6l2.05-2.05a1 1 0 0 1 1-.27l4 1a1 1 0 0 1 .75 1Z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-industrial-dark text-lg mb-2">Telefon</h3>
                        <a href="tel:+420776089310" class="text-muted-foreground hover:text-primary transition-colors font-medium">+420 776 089 310</a>
                        <p class="text-sm text-muted-foreground mt-1">Volejte kdykoliv, jsme tu pro Vás.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-subtle p-6">
                <div class="flex items-start space-x-4">
                    <div class="bg-primary p-3 rounded-full text-white">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-industrial-dark text-lg mb-2">Email</h3>
                        <a href="mailto:franta.rys@gmail.com" class="text-muted-foreground hover:text-primary transition-colors font-medium">franta.rys@gmail.com</a>
                        <p class="text-sm text-muted-foreground mt-1">Odpovídáme do 24 hodin.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-subtle p-6">
                <div class="flex items-start space-x-4">
                    <div class="bg-primary p-3 rounded-full text-white">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-industrial-dark text-lg mb-2">Oblast působnosti</h3>
                        <p class="text-muted-foreground">Praha a okolí (50 km)</p>
                        <p class="text-sm text-muted-foreground mt-1">Další oblasti na dotaz.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-subtle p-6">
                <div class="flex items-start space-x-4">
                    <div class="bg-primary p-3 rounded-full text-white">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-industrial-dark text-lg mb-2">Pracovní doba</h3>
                        <p class="text-muted-foreground">Po – Pá: 7:00 – 18:00</p>
                        <p class="text-muted-foreground">So: 8:00 – 14:00</p>
                        <p class="text-sm text-muted-foreground mt-1">Pohotovost 24/7.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-subtle p-8">
            <h3 class="text-2xl font-bold text-industrial-dark mb-6">Nezávazná poptávka</h3>

            @if (session('contact_success'))
                <div role="status" class="mb-4 rounded-md bg-green-50 border border-green-200 text-green-800 px-4 py-3">
                    {{ session('contact_success') }}
                </div>
            @endif

            @if (session('contact_error'))
                <div role="alert" class="mb-4 rounded-md bg-red-50 border border-red-200 text-red-800 px-4 py-3">
                    {{ session('contact_error') }}
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4" novalidate>
                @csrf

                <div class="hidden" aria-hidden="true">
                    <label>Webová stránka<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="contact-name" class="block text-sm font-medium text-industrial-dark mb-1">Jméno a příjmení *</label>
                        <input
                            id="contact-name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            maxlength="120"
                            autocomplete="name"
                            class="w-full rounded-md border border-input bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                        @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="contact-email" class="block text-sm font-medium text-industrial-dark mb-1">E-mail *</label>
                        <input
                            id="contact-email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            maxlength="190"
                            autocomplete="email"
                            class="w-full rounded-md border border-input bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                        @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="contact-phone" class="block text-sm font-medium text-industrial-dark mb-1">Telefon</label>
                    <input
                        id="contact-phone"
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        maxlength="32"
                        autocomplete="tel"
                        class="w-full rounded-md border border-input bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                    @error('phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="contact-message" class="block text-sm font-medium text-industrial-dark mb-1">Zpráva *</label>
                    <textarea
                        id="contact-message"
                        name="message"
                        rows="5"
                        required
                        minlength="10"
                        maxlength="5000"
                        class="w-full rounded-md border border-input bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                    >{{ old('message') }}</textarea>
                    @error('message') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <label class="flex items-start space-x-2 text-sm text-muted-foreground">
                    <input type="checkbox" name="consent" value="1" required class="mt-1">
                    <span>Souhlasím se zpracováním osobních údajů za účelem vyřízení poptávky.</span>
                </label>
                @error('consent') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror

                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-gradient-primary text-white font-medium shadow-red hover:opacity-90 transition-opacity">
                    Odeslat poptávku
                </button>
            </form>
        </div>
    </div>
</section>
