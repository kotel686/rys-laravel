<footer class="bg-industrial-dark text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <h3 class="text-2xl font-bold text-primary mb-4">Lezecká stěna</h3>
                <p class="text-industrial-light mb-4 leading-relaxed max-w-md">
                    Moderní lezecká stěna pro děti i dospělé.
                </p>
                <p class="text-sm text-industrial-light">
                    Provozuje <a href="{{ url('/') }}" class="hover:text-primary transition-colors">František Rys – Výškové práce</a>.
                </p>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-4">Rychlé odkazy</h4>
                <ul class="space-y-2 text-industrial-light">
                    <li><a href="{{ route('climbing.about') }}" class="hover:text-primary transition-colors">O stěně</a></li>
                    <li><a href="{{ route('climbing.pricing') }}" class="hover:text-primary transition-colors">Ceník</a></li>
                    <li><a href="{{ route('climbing.programs') }}" class="hover:text-primary transition-colors">Kroužky a oddíl</a></li>
                    <li><a href="{{ route('climbing.news.index') }}" class="hover:text-primary transition-colors">Aktuality</a></li>
                    <li><a href="{{ route('climbing.contact') }}" class="hover:text-primary transition-colors">Kontakt</a></li>
                </ul>
            </div>

            @php
                $openingHours = \App\Models\ClimbingOpeningHour::forDisplay();
            @endphp

            @if ($openingHours->isNotEmpty())
                <div>
                    <h4 class="text-lg font-bold mb-4">Otevírací doba</h4>
                    <ul class="space-y-2 text-industrial-light text-sm">
                        @foreach ($openingHours as $row)
                            <li><span class="text-white font-medium">{{ $row->day_label }}</span><br>{{ $row->hours }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <hr class="border-industrial-medium my-8">

        <div class="flex flex-col md:flex-row justify-between items-center text-sm text-industrial-light">
            <div>© {{ now()->year }} Lezecká stěna – František Rys. Všechna práva vyhrazena.</div>
            <div class="mt-4 md:mt-0">vyskovepracerys.cz/lezeckastena</div>
        </div>
    </div>
</footer>
