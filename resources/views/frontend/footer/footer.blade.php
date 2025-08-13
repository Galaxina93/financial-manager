<!-- Footer -->
<footer class="relative text-white py-16 overflow-hidden">
    <!-- Hintergrundbild -->
    <div class="absolute inset-0">
        <img src="{{ URL::to('/images/fmi/werbung.jpeg') }}" alt="Footer Hintergrund" class="w-full h-full object-cover">
        <div class="absolute inset-0" style="background-color: rgba(155, 56, 111, 0.6);"></div>
    </div>

    <!-- Inhalt -->
    <div class="relative z-10 max-w-7xl mx-auto py-10 px-6 lg:px-12 grid grid-cols-1 md:grid-cols-3 gap-10" style="background-color: rgba(155, 56, 111, 0.7);">

        <!-- Partnerlogo & Info -->
        <div>
            <img src="{{ URL::to('/images/fmi/Logo_mtv.png') }}" alt="MTV Braunschweig Logo" class="w-36 mb-4">
            <p class="text-sm text-gray-200">Offizieller Partner des MTV Braunschweig</p>
        </div>

        <!-- Standorte -->
        <div>
            <h4 class="text-lg font-semibold mb-3 text-white">Standorte</h4>
            <p class="text-gray-100 text-sm mb-2">
                <span class="font-medium">Büro:</span><br>
                Berliner Platz 1d<br>
                38102 Braunschweig
            </p>
            <p class="text-gray-100 text-sm">
                <span class="font-medium">Lager & Werkstatt:</span><br>
                Heinrichstraße 12<br>
                31224 Peine
            </p>
        </div>

        <!-- Kontakt & Links -->
        <div>
            <h4 class="text-lg font-semibold mb-3 text-white">Kontakt & Links</h4>
            <ul class="text-gray-100 text-sm space-y-2">
                <li><a href="https://felix-machts.com" class="hover:text-white transition">felix-machts.com</a></li>
                <li><a href="mailto:info@felix-machts.com" class="hover:text-white transition">info@felix-machts.com</a></li>
                <li><a href="mailto:hallo@felix-machts.com" class="hover:text-white transition">Schadensmeldung einreichen</a></li>
                <li><a href="/impressum" class="hover:text-white transition">Impressum</a></li>
                <li><a href="/datenschutz" class="hover:text-white transition">Datenschutzerklärung</a></li>
                <li>
                    <span class="block text-white font-semibold mb-1">Notfallnummer (nur für aktive Kunden):</span>
                    <a href="tel:015142030438" class="inline-block text-white font-bold px-3 py-2 rounded-md text-base hover:bg-red-700 transition">
                        0151 4203 0438
                    </a>
                </li>
            </ul>
        </div>

    </div>

    <!-- Copyright -->
    <div class="relative z-10 mt-12 text-center text-gray-200 text-sm pt-6">
        &copy; 2025 Felix Machts. Alle Rechte vorbehalten.
    </div>
</footer>
