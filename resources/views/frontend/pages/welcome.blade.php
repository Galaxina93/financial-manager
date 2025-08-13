<x-layouts.frontend_layout>

    <x-sections.page-container>

        <!-- Hero Section -->
        <section id="home"
                 class="relative pt-16 overflow-hidden text-white"
                 style="background: url('{{ URL::to('/images/fmi/bg.png') }}') center/cover no-repeat;"
                 aria-label="Hausmeisterservice Felix Machts in Braunschweig & Peine">

            <!-- Schwarzer Schleier über dem Bild -->
            <div class="absolute inset-0 bg-black opacity-60"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-40 relative z-10">
                <div class="text-center">
                    <h1 class="text-5xl md:text-7xl font-bold mb-14 floating-animation">
                        Weil Vertrauen zählt!
                    </h1>

                    <p class="text-xl md:text-2xl mb-14 opacity-90">
                        <strong>Hausmeisterservice Braunschweig & Peine:</strong> Zuverlässig, zertifiziert & professionell.<br>
                        <strong>Elektrofachbetrieb, Gartenpflege, Gebäudereinigung</strong> – alles aus einer Hand.
                    </p>

                    <!-- Hauptbuttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                        <button onclick="scrollToContact()"
                                class="bg-white text-primary px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all transform hover:scale-105 pulse-button"
                                aria-label="Jetzt unverbindlich Kontakt aufnehmen">
                            JETZT Anfrage senden
                        </button>

                        <a href="{{ url('/calculator') }}" target="_blank"
                           class="bg-transparent border-2 border-primary px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-primary transition-all transform hover:scale-105"
                           aria-label="Kostenrechner starten">
                            Kosten Kalkulator starten
                        </a>
                    </div>

                    <!-- Standardtelefonnummer -->
                    <div class="flex justify-center items-center gap-2 text-white mt-4">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        <a href="tel:+4953112889733" class="hover:underline text-2xl">
                            +49 531 1288 9733
                        </a>
                    </div>

                    <p class="text-sm mt-4 opacity-75">
                        Ihre Anfrage ist natürlich komplett unverbindlich
                    </p>
                </div>
            </div>

            <!-- Dekorative Elemente -->
            <div class="absolute top-20 left-10 w-20 h-20 bg-white opacity-10 rounded-full floating-animation"></div>
            <div class="absolute bottom-20 right-10 w-32 h-32 bg-white opacity-10 rounded-full floating-animation" style="animation-delay: 1s;"></div>
        </section>

        <!-- Service Section -->
        <section id="services" class="bg-white text-black py-24 px-6 lg:px-12">
            <header class="text-center mb-16">
                <h2 class="text-primary font-bold text-3xl sm:text-4xl lg:text-5xl">Unsere Leistungen für Immobilien und Grundstücke</h2>
                <p class="mt-4 text-gray-600 text-base max-w-3xl mx-auto">Entdecken Sie unser umfassendes Leistungsportfolio rund um Haus, Garten und Gebäudeinstandhaltung.</p>
            </header>

            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                {{-- Leistung: Renovierungen & Handwerk --}}
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105 motion-safe:animate-fadeIn" style="animation-delay: 0s;">
                    <figure>
                        <img src="{{ URL::to('/images/fmi/Renovierungen und Handwerk.jpeg') }}" alt="Professionelle Renovierungen und handwerkliche Dienstleistungen" class="w-full h-56 object-cover">
                    </figure>
                    <div class="bg-gradient-to-br from-pink-700 to-pink-800 p-6">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-pink-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Renovierungen & Handwerk</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Individuelle handwerkliche Arbeiten und Renovierungen – von kleinen Reparaturen bis zum kompletten Innenausbau.</p>
                        <ul class="text-sm text-gray-500 space-y-1 list-disc list-inside">
                            <li>Elektroinstallationen</li>
                            <li>Innenausbau & Trockenbau</li>
                            <li>Montagearbeiten</li>
                        </ul>
                    </div>
                </article>

                {{-- Leistung: Garten- & Grundstückspflege --}}
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105 motion-safe:animate-fadeIn" style="animation-delay: 0.2s;">
                    <figure>
                        <img src="{{ URL::to('/images/fmi/Garten- und Grundstückspflege.jpeg') }}" alt="Gartenpflege und professionelle Grundstücksbetreuung" class="w-full h-56 object-cover">
                    </figure>
                    <div class="bg-gradient-to-br from-green-500 to-green-600 p-6">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Garten- & Grundstückspflege</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Ganzjährige Pflege für Grünflächen, Hecken und Bäume – nachhaltig und professionell durchgeführt.</p>
                        <ul class="text-sm text-gray-500 space-y-1 list-disc list-inside">
                            <li>Rasen mähen & Pflege</li>
                            <li>Hecken- & Strauchschnitt</li>
                            <li>Baum- & Gehölzpflege</li>
                        </ul>
                    </div>
                </article>

                {{-- Leistung: Reinigung & Instandhaltung --}}
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105 motion-safe:animate-fadeIn" style="animation-delay: 0.4s;">
                    <figure>
                        <img src="{{ URL::to('/images/fmi/Reinigungsarbeiten und Instandhaltungsarbeiten.jpeg') }}" alt="Gebäudereinigung und technische Instandhaltung" class="w-full h-56 object-cover">
                    </figure>
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Reinigung & Instandhaltung</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Professionelle Reinigung und kontinuierliche Wartung für den Werterhalt Ihrer Immobilie.</p>
                        <ul class="text-sm text-gray-500 space-y-1 list-disc list-inside">
                            <li>Treppenhausreinigung</li>
                            <li>Glas- & Fensterreinigung</li>
                            <li>Dachrinnenreinigung</li>
                        </ul>
                    </div>
                </article>

                {{-- Leistung: Winterdienst --}}
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105 motion-safe:animate-fadeIn" style="animation-delay: 0.6s;">
                    <figure>
                        <img src="{{ URL::to('/images/fmi/Winterdienst.jpeg') }}" alt="Winterdienst mit Schneeräumung und Streudienst" class="w-full h-56 object-cover">
                    </figure>
                    <div class="bg-gradient-to-br from-gray-600 to-gray-700 p-6">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 0 0 4.5 4.5H18a3.75 3.75 0 0 0 1.332-7.257 3 3 0 0 0-3.758-3.848 5.25 5.25 0 0 0-10.233 2.33A4.502 4.502 0 0 0 2.25 15Z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Winterdienst</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Sicher durch den Winter – zuverlässige Schneeräumung und Streudienste mit 24/7-Bereitschaft.</p>
                        <ul class="text-sm text-gray-500 space-y-1 list-disc list-inside">
                            <li>Schneeräumung von Gehwegen & Zufahrten</li>
                            <li>Streudienst mit Umweltverträglichkeit</li>
                            <li>Rund-um-die-Uhr-Service</li>
                        </ul>
                    </div>
                </article>

                {{-- Leistung: Regelmäßige Kontrollen --}}
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105 motion-safe:animate-fadeIn" style="animation-delay: 0.8s;">
                    <figure>
                        <img src="{{ URL::to('/images/fmi/Regelmäßige Kontrollen.jpeg') }}" alt="Objektkontrolle und technische Wartung" class="w-full h-56 object-cover">
                    </figure>
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-orange-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Regelmäßige Kontrollen</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Sicherheitsrelevante Kontrollen und Zustandsprüfungen für Gebäude, Anlagen und Außenbereiche.</p>
                        <ul class="text-sm text-gray-500 space-y-1 list-disc list-inside">
                            <li>Objektbegehungen</li>
                            <li>Schadensfrüherkennung</li>
                            <li>Wartung technischer Einrichtungen</li>
                        </ul>
                    </div>
                </article>

                {{-- Leistung: Teamwork --}}
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105 motion-safe:animate-fadeIn" style="animation-delay: 1s;">
                    <figure>
                        <img src="{{ URL::to('/images/fmi/Teamwork.jpeg') }}" alt="Effiziente Teamarbeit für Gebäudedienstleistungen" class="w-full h-56 object-cover">
                    </figure>
                    <div class="bg-gradient-to-br from-primary to-primary-dark p-6">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-primary">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Teamwork</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Unsere motivierten Teams arbeiten effizient und lösungsorientiert für höchste Kundenzufriedenheit.</p>
                        <ul class="text-sm text-gray-500 space-y-1 list-disc list-inside">
                            <li>Engagiertes Fachpersonal</li>
                            <li>Koordinierte Abläufe</li>
                            <li>Klare Kommunikation</li>
                        </ul>
                    </div>
                </article>

            </div>
        </section>

        <!-- Work Areas Section -->
        <section id="portfolio" class="bg-white overflow-hidden">

            <!-- WEGs -->
            <div id="fuer-wegs" class="relative bg-primary overflow-hidden">
                <div class="h-56 sm:h-72 md:absolute md:right-0 md:h-full md:w-1/2">
                    <img class="w-full h-full object-cover" src="{{ URL::to('/images/fmi/wegs.jpeg') }}" alt="WEGs">
                </div>
                <div class="relative max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
                    <div class="md:w-1/2 md:pr-12">
                        <h3 class="text-base font-semibold uppercase tracking-wider text-white">Für Wohnungs-<br>eigentümergemeinschaften (WEG)</h3>
                        <p class="mt-2 text-white text-3xl font-extrabold sm:text-4xl">
                            <span>216</span>+ erfolgreiche Projekte
                        </p>
                        <ul class="mt-4 space-y-2 text-white text-lg list-none">
                            <li>✅ Renovierungen und Handwerk</li>
                            <li>✅ Garten- und Grundstückspflege</li>
                            <li>✅ Reinigungsarbeiten und Instandhaltungsarbeiten</li>
                            <li>✅ Winterdienst</li>
                            <li>✅ Regelmäßige Kontrollen</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Eigenheimbesitzer -->
            <div id="fuer-eigenheimbesitzer" class="relative bg-gray-100 overflow-hidden">
                <div class="h-56 sm:h-72 md:absolute md:left-0 md:h-full md:w-1/2">
                    <img class="w-full h-full object-cover" src="{{ URL::to('/images/fmi/eigenheimbesitzer.jpeg') }}" alt="Eigenheimbesitzer">
                </div>
                <div class="relative max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
                    <div class="md:ml-auto md:w-1/2 md:pl-12 md:text-right">
                        <h3 class="text-base font-semibold uppercase tracking-wider text-primary">Für Eigenheimbesitzer</h3>
                        <p class="mt-2 text-gray-900 text-3xl font-extrabold sm:text-4xl">
                            <span class="text-primary">403+</span> betreute Haushalte
                        </p>
                        <ul class="mt-4 space-y-3 text-gray-700 text-lg list-none">
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Hausmeisterdienste & Kleinreparaturen</span>
                            </li>
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Technik-Wartung & Fenster-/Sanitärkontrolle</span>
                            </li>
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Reinigungsarbeiten (Fenster, Dach, Rinnen)</span>
                            </li>
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Gartenpflege & Winterdienst</span>
                            </li>
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Renovierungen & Handwerkskoordination</span>
                            </li>
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Umzugsservice & Montage</span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <!-- Gewerbekunden -->
            <div id="fuer-gewerbekunden" class="relative bg-primary overflow-hidden">
                <div class="h-56 sm:h-72 md:absolute md:right-0 md:h-full md:w-1/2">
                    <img class="w-full h-full object-cover" src="{{ URL::to('/images/fmi/gewerbekunden.jpeg') }}" alt="Gewerbekunden">
                </div>
                <div class="relative max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
                    <div class="md:w-1/2 md:pr-12">
                        <h3 class="text-base font-semibold uppercase tracking-wider text-white">Für Gewerbekunden</h3>
                        <p class="mt-2 text-white text-3xl font-extrabold sm:text-4xl">
                            <span>76</span>+ betreute Objekte
                        </p>
                        <ul class="mt-4 space-y-2 text-white text-lg list-none">
                            <li>✅ Garten- & Grundstückspflege</li>
                            <li>✅ Instandhaltung & Renovierungen</li>
                            <li>✅ Hausverwaltung & Hausmeisterservice</li>
                            <li>✅ Macher-Hotline für spontane Hilfe</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Mieter -->
            <div id="fuer-mieter" class="relative bg-gray-100 overflow-hidden">
                <div class="h-56 sm:h-72 md:absolute md:left-0 md:h-full md:w-1/2">
                    <img class="w-full h-full object-cover" src="{{ URL::to('/images/fmi/mieter.jpeg') }}" alt="Mieter">
                </div>
                <div class="relative max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
                    <div class="md:ml-auto md:w-1/2 md:pl-12 md:text-right">
                        <h3 class="text-base font-semibold uppercase tracking-wider text-primary">Für Mieter</h3>
                        <p class="mt-2 text-gray-900 text-3xl font-extrabold sm:text-4xl">
                            <span class="text-primary">196+</span> erledigte Projekte
                        </p>
                        <p class="mt-4 text-lg text-gray-700">
                            Ob Reparaturanliegen oder Fragen zur Wohnung – wir stehen Ihnen mit schnellem Service zur Seite.
                        </p>
                        <ul class="mt-6 space-y-3 text-gray-700 text-lg list-none">
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Unterstützung bei Mietanliegen</span>
                            </li>
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Schnelle Hilfe bei Reparaturen</span>
                            </li>
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Kommunikation mit Hausverwaltung</span>
                            </li>
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Koordination von Handwerkern</span>
                            </li>
                            <li class="flex items-start gap-2 flex-row md:flex-row-reverse">
                                <span class="text-green-600 text-xl">✅</span>
                                <span>Zuverlässiger Ansprechpartner vor Ort</span>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </section>

        <!-- About Section -->
        <section id="about" class="bg-gray-100 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 fade-in">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Warum Felix Machts.?</h2>
                    <p class="text-xl text-gray-600 mb-6">
                        Weil Ihre Zeit kostbar ist – wir kümmern uns um den Rest. Persönlich, lösungsorientiert und mit vollem Einsatz.
                    </p>
                    <a href="{{ URL::to('/images/fmi/flyer/Felix_Machts_Flyer.pdf') }}" download
                       class="inline-flex items-center px-6 py-3 bg-primary text-white text-base font-medium rounded-lg shadow hover:bg-primary-700 transition">
                        📄 Flyer herunterladen
                    </a>
                </div>

                <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 overflow-x-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-center">

                        <div class="fade-in">
                            <div class="bg-white rounded-2xl p-8 shadow-lg">
                                <div class="flex items-start gap-4 mb-6">
                                    <img src="{{ URL::to('/images/fmi/felix_profilbild.jpeg') }}" alt="Felix Flachsbart"
                                         class="w-14 h-14 rounded-full object-cover border-2 border-primary max-w-full" />
                                    <div>
                                        <div class="text-primary text-3xl mb-2">“</div>
                                        <h3 class="text-xl font-semibold text-gray-800">Felix Flachsbart</h3>
                                        <p class="text-sm text-gray-500">Mitgründer von Felix Machts</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 mb-4">
                                    Wir sind Felix & Alex – zwei Schulfreunde aus Peine, die sich gefragt haben:
                                    Warum ist es so schwer, verlässliche und flexible Hilfe rund ums Haus zu finden?
                                    Warum muss man sich durch endlose Telefonate quälen, nur um dann doch monatelang
                                    auf eine Lösung zu warten?
                                </p>
                                <div class="p-4 rounded-lg mb-4">
                                    <p class="font-semibold">
                                        Unsere Antwort: <span class="text-primary font-bold bg-white px-1 rounded">Es geht besser!</span>
                                    </p>
                                </div>
                                <p class="text-gray-700">
                                    Genau deshalb haben wir <strong>Felix Machts.</strong> gegründet.
                                    Der Name ist unser Versprechen: Egal, welches Problem rund um euer Zuhause ansteht – wir finden eine Lösung.
                                </p>
                            </div>
                        </div>

                        <div class="fade-in" style="animation-delay: 0.3s;">
                            <div class="space-y-6">
                                <!-- Card 1: Lösungsorientiert -->
                                <div class="bg-white rounded-2xl p-6 shadow-lg transform hover:scale-105 transition-transform">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                            </svg>
                                        </div>
                                        <h4 class="text-base sm:text-sm md:text-lg xl:text-2xl font-bold text-gray-900 ml-4">
                                            Lösungsorientiert statt kompliziert
                                        </h4>
                                    </div>
                                    <p class="text-gray-600">Wir finden für jedes Problem die passende Lösung</p>
                                </div>

                                <!-- Card 2: Persönlich -->
                                <div class="bg-white rounded-2xl p-6 shadow-lg transform hover:scale-105 transition-transform">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                                            <!-- Heroicon: User Group (Team & persönliche Nähe) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1m-6 6v-2a4 4 0 00-4-4H4a4 4 0 00-4 4v2h5m6-6a4 4 0 100-8 4 4 0 000 8zm6-2a3 3 0 100-6 3 3 0 000 6z" />
                                            </svg>
                                        </div>
                                        <h4 class="xl:text-xl md:text-base sm:text-small font-bold text-gray-900 ml-4">Persönlich statt anonym</h4>
                                    </div>
                                    <p class="text-gray-600">Direkter Kontakt und persönliche Betreuung</p>
                                </div>

                                <!-- Card 3: Schnell & zuverlässig -->
                                <div class="bg-white rounded-2xl p-6 shadow-lg transform hover:scale-105 transition-transform">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                                            <!-- Heroicon: Bolt (Schnelligkeit & Effizienz) -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <h4 class="xl:text-xl md:text-base sm:text-small font-bold text-gray-900 ml-4">Schnell & zuverlässig</h4>
                                    </div>
                                    <p class="text-gray-600">Statt monatelang warten – schnelle Umsetzung</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Team Content -->
                <section class="bg-white overflow-hidden">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-gray-900">

                        <div class="mb-20 space-y-12">
                            <!-- Felix & Alex -->
                            <div class="flex flex-col sm:flex-row items-center gap-6">
                                <img src="{{ URL::to('/images/fmi/felix.jpeg') }}" alt="Felix Flachsbart"
                                     class="w-40 h-40 rounded-full border-4 border-primary object-cover" />
                                <div class="text-center sm:text-left">
                                    <h3 class="text-3xl font-bold">Felix Flachsbart</h3>
                                    <p class="text-primary font-semibold">Inhaber und Geschäftsführer, Felix Machts.</p>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center gap-6">
                                <img src="{{ URL::to('/images/fmi/alex.jpeg') }}" alt="Alexander Grüssmer"
                                     class="w-40 h-40 rounded-full border-4 border-primary object-cover" />
                                <div class="text-center sm:text-left">
                                    <h3 class="text-3xl font-bold">Alexander Grüssmer</h3>
                                    <p class="text-primary font-semibold">Geschäftsführung – Vertrieb & Marketing</p>
                                </div>
                            </div>
                        </div>

                        <h2 class="text-3xl font-bold mb-8">Internes Personal</h2>
                        <p class="mb-10 max-w-3xl text-lg text-gray-700">
                            Neben den hier gezeigten Mitarbeitern gibt es natürlich noch viele weitere Kolleg:innen, die nicht im Büro
                            arbeiten, aber rund um die Uhr für unsere Kunden im Einsatz sind. Ihre Fotos und Namen folgen bald –
                            reinschauen lohnt sich! 😉
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <!-- Torsten Stief -->
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 text-center md:text-left">
                                <img src="{{ URL::to('/images/fmi/torsten_stief.jpeg') }}" alt="Torsten Stief"
                                     class="w-32 h-32 rounded-full border-4 border-primary object-cover" />
                                <div>
                                    <h3 class="text-2xl font-bold">Torsten Stief</h3>
                                    <p class="font-semibold text-primary">Leitung Hausmeisterservice</p>
                                    <p class="text-gray-700 mt-1">
                                        Jahrelange Erfahrung in Personaleinsatzplanung und Qualitätssicherung.
                                    </p>
                                </div>
                            </div>

                            <!-- Sergei Wolochow -->
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 text-center md:text-left">
                                <img src="{{ URL::to('/images/fmi/sergei_wolochow.jpeg') }}" alt="Sergei Wolochow"
                                     class="w-32 h-32 rounded-full border-4 border-primary object-cover" />
                                <div>
                                    <h3 class="text-2xl font-bold">Sergei Wolochow</h3>
                                    <p class="font-semibold text-primary">Leitung Projektgeschäft</p>
                                    <p class="text-gray-700 mt-1">
                                        Er hat ein Gespür für kreative Lösungen und strebt nach den bestmöglichen Ergebnissen.
                                    </p>
                                </div>
                            </div>

                            <!-- Kim Garnatz -->
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 text-center md:text-left">
                                <img src="{{ URL::to('/images/fmi/kim_garnatz.jpeg') }}" alt="Kim Garnatz"
                                     class="w-32 h-32 rounded-full border-4 border-primary object-cover" />
                                <div>
                                    <h3 class="text-2xl font-bold">Kim Garnatz</h3>
                                    <p class="font-semibold text-primary">Buchhaltung & Assistenz</p>
                                    <p class="text-gray-700 mt-1">
                                        Zuständig für Angebotserstellung, Rechnungen und Kundenkommunikation.
                                    </p>
                                </div>
                            </div>

                            <!-- Ksenia Grüssmer -->
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 text-center md:text-left">
                                <img src="{{ URL::to('/images/fmi/ksenia_gruessmer.jpeg') }}" alt="Ksenia Grüssmer"
                                     class="w-32 h-32 rounded-full border-4 border-primary object-cover" />
                                <div>
                                    <h3 class="text-2xl font-bold">Ksenia Grüssmer</h3>
                                    <p class="font-semibold text-primary">Buchhaltung</p>
                                    <p class="text-gray-700 mt-1">
                                        Zuständig für Abrechnung, Lohnbuchhaltung und Einkauf.
                                    </p>
                                </div>
                            </div>

                            <!-- Alexander Wolochow -->
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 text-center md:text-left">
                                <img src="{{ URL::to('/images/fmi/alexander_wolochow.jpeg') }}" alt="Alexander Wolochow"
                                     class="w-32 h-32 rounded-full border-4 border-primary object-cover" />
                                <div>
                                    <h3 class="text-2xl font-bold">Alexander Wolochow</h3>
                                    <p class="font-semibold text-primary">Leitung Objektbetreuung Peine</p>
                                    <p class="text-gray-700 mt-1">
                                        Betreut feste Objekte und verwaltet Werkzeuge & Fahrzeuge.
                                    </p>
                                </div>
                            </div>

                            <!-- Sara Eggeling -->
                            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 text-center md:text-left">
                                <img src="{{ URL::to('/images/fmi/sara_eggeling.jpeg') }}" alt="Sara Eggeling"
                                     class="w-32 h-32 rounded-full border-4 border-primary object-cover" />
                                <div>
                                    <h3 class="text-2xl font-bold">Sara Eggeling</h3>
                                    <p class="font-semibold text-primary">Marketing</p>
                                    <p class="text-gray-700 mt-1">
                                        Verantwortlich für Onlineauftritt, Social Media und Werbematerial.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>


            </div>
        </section>

        <!-- CTA Section -->
        <section class="hero-gradient text-white py-20 relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <div class="fade-in">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">Bereit für Ihr Projekt?</h2>
                    <p class="text-xl mb-8 opacity-90">
                        Lassen Sie uns gemeinsam Ihre Wohnträume verwirklichen
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <button onclick="scrollToContact()" class="bg-white text-primary px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all transform hover:scale-105 pulse-button">
                            Jetzt unverbindlich anfragen
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section id="process" class="bg-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 fade-in">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">In 5 Schritten zum Traumergebnis</h2>
                    <p class="text-xl text-gray-600">Weil Ihre Zeit wertvoll ist!</p>
                </div>

                <div class="relative">
                    <!-- Progress Line -->
                    <div class="hidden lg:block absolute top-16 left-0 w-full h-1 bg-gray-200 my-4">
                        <div class="h-full bg-gradient-to-r from-primary to-primary-light w-full"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                        <!-- Step 1 -->
                        <div class="text-center fade-in">
                            <div class="relative">
                                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4 shadow-lg">
                                    1
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 pt-4">Kontaktaufnahme</h3>
                            <p class="text-gray-600 text-sm">Anruf, E-Mail oder Kontaktformular</p>
                        </div>

                        <!-- Step 2 -->
                        <div class="text-center fade-in" style="animation-delay: 0.2s;">
                            <div class="relative">
                                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4 shadow-lg">
                                    2
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 pt-4">Bedarfsanalyse</h3>
                            <p class="text-gray-600 text-sm">Wir analysieren Ihre Anforderungen</p>
                        </div>

                        <!-- Step 3 -->
                        <div class="text-center fade-in" style="animation-delay: 0.4s;">
                            <div class="relative">
                                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4 shadow-lg">
                                    3
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 pt-4">Angebotserstellung</h3>
                            <p class="text-gray-600 text-sm">Transparentes und faires Angebot</p>
                        </div>

                        <!-- Step 4 -->
                        <div class="text-center fade-in" style="animation-delay: 0.6s;">
                            <div class="relative">
                                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4 shadow-lg">
                                    4
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 pt-4">Durchführung</h3>
                            <p class="text-gray-600 text-sm">Terminvereinbarung und professionelle Umsetzung</p>
                        </div>

                        <!-- Step 5 -->
                        <div class="text-center fade-in" style="animation-delay: 0.8s;">
                            <div class="relative">
                                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4 shadow-lg">
                                    5
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 pt-4">Abnahme</h3>
                            <p class="text-gray-600 text-sm">Qualitätskontrolle und Nachbetreuung</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12 fade-in">
                    <p class="text-xl text-gray-600 mb-8 italic">
                        "Nicht lange nach dem besten Partner für Ihre Hausmeistertätigkeiten suchen.
                        Einfach den Button klicken und mit einer Anfrage direkt ihr Traumergebnis finden!"
                    </p>
                    <button onclick="scrollToContact()" class="bg-primary text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-primary-dark transition-all transform hover:scale-105 pulse-button">
                        JETZT Kontakt aufnehmen
                    </button>
                </div>
            </div>
        </section>

        <!-- 360° Section -->
        <section id="360" class="py-24 bg-gray-50 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
                <div class="grid md:grid-cols-2 gap-12 items-center">

                    <!-- Text -->
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">
                            360° Liegenschafts-<br>betreuung
                        </h2>
                        <p class="text-gray-700 text-lg mb-6 leading-relaxed">
                            Mit unserer 360° Liegenschaftsbetreuung erhalten Sie einen umfassenden Hausmeisterservice – zuverlässig, effizient und persönlich.
                        </p>
                        <ul class="space-y-3 text-gray-600 text-base mb-8">
                            <li>✔ Objektkontrollen & Instandhaltung</li>
                            <li>✔ Reinigung, Gartenpflege & Winterdienst</li>
                            <li>✔ Koordination externer Fachfirmen</li>
                            <li>✔ Persönlicher Ansprechpartner</li>
                        </ul>

                        <div class="bg-white rounded-xl p-5 shadow mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Warum unser Online-Kalkulator?</h3>
                            <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
                                <li>Sofortige Preisschätzung nach Bedarf</li>
                                <li>Modular aufgebaut & leicht bedienbar</li>
                                <li>Ergebnisse als PDF per E-Mail</li>
                            </ul>
                            <!-- CTA Button -->
                            <a href="{{ url('/calculator') }}"
                               target="_blank"
                               class="inline-block bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-3 mt-8 rounded-lg shadow transition duration-200">
                                Kalkulator öffnen
                            </a>
                        </div>

                    </div>

                    <!-- Bild -->
                    <div class="flex justify-center">
                        <img src="{{ asset('images/fmi/360-Liegenschaftsbetreuung.png') }}"
                             alt="360° Betreuung"
                             class="w-72 max-w-sm object-contain">
                    </div>
                </div>
            </div>
        </section>


        <!--References Section-->
        <section id="reference" class="bg-white py-16 px-6 md:px-12">
            <div class="max-w-7xl mx-auto text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Was wir schon gemacht haben</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Ein kleiner Einblick in unsere Arbeiten. Alle aufgezeigten Tätigkeiten wurden bei unterschiedlichen Kunden durchgeführt.</p>
            </div>

            <div class="my-12">
                <div class="max-w-5xl mx-auto">
                    @livewire('global.widgets.header-slider')
                </div>
            </div>

            {{--Zwei Bilder pro Kachel--}}
            {{--<div class="max-w-6xl mx-auto grid gap-6 grid-cols-1 sm:grid-cols-2 text-left">
                @php
                    $items = [
                        ['image1' => '/images/slider/Bau eines Zauns.jpg', 'image2' => '/images/slider/Hecken rückschneiden.jpg', 'title' => 'Zaunbau & Heckenrückschnitt', 'text' => 'Gerader Zaun mit Pforte & gepflegte Hecken – sauber getrennt und effizient umgesetzt.'],
                        ['image1' => '/images/slider/Rasen vertikutieren.jpg', 'image2' => '/images/slider/Dach reinigen.jpg', 'title' => 'Rasenpflege & Dachreinigung', 'text' => 'Grüner Rasen, sauberes Dach – für einen gepflegten Außenbereich.'],
                        ['image1' => '/images/slider/Schornstein ausleeren.jpg', 'image2' => '/images/slider/Lampen anbauen.jpg', 'title' => 'Schornstein & Lampen', 'text' => 'Bauschutt raus, Licht rein – clever kombiniert.'],
                        ['image1' => '/images/slider/Neue Türen samt Zargen einbauen.jpg', 'image2' => '/images/slider/Silikonfugen erneuern.jpg', 'title' => 'Türen & Fugen erneuern', 'text' => 'Neue Türen, neue Hygiene – professionell umgesetzt.'],
                        ['image1' => '/images/slider/Dachrinnen reinigen.jpg', 'image2' => '/images/slider/Garten erneuern.jpg', 'title' => 'Dachrinne & Gartenpflege', 'text' => 'Garten neu gedacht & Wasserablauf gesichert.'],
                        ['image1' => '/images/slider/Hof mit Hochdruckreiniger säubern.jpg', 'image2' => '/images/slider/Garageneinfahrt neu pflastern.jpg', 'title' => 'Hofreinigung & Pflasterarbeiten', 'text' => 'Sauberkeit und neuer Bodenbelag für Außenbereiche.'],
                        ['image1' => '/images/slider/Badezimmer bauen.jpg', 'image2' => '/images/slider/Tapezieren der Wände.jpg', 'title' => 'Badezimmer & Tapeten', 'text' => 'Bad modernisieren und Wohnräume auffrischen.'],
                        ['image1' => '/images/slider/Boden neu verlegen.jpg', 'image2' => '/images/slider/Lampen und Steckdosen anbringen.jpg', 'title' => 'Boden & Elektrik', 'text' => 'Solider Untergrund trifft auf sichere Elektrik.'],
                        ['image1' => '/images/slider/Fassaden reinigen.jpg', 'image2' => '/images/slider/Trockenbauarbeiten.jpg', 'title' => 'Fassade & Trockenbau', 'text' => 'Frischer Look für außen und flexible Raumlösungen innen.'],
                        ['image1' => '/images/slider/Giebelwand dämmen.jpg', 'image2' => '/images/slider/Rückbau Küche.jpg', 'title' => 'Dämmung & Rückbau', 'text' => 'Energieeffizienz durch Giebelwanddämmung – alte Küchen weichen für neue Möglichkeiten.'],
                    ];
                @endphp

                @foreach ($items as $item)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition duration-300 ease-in-out hover:-translate-y-2 hover:scale-105 hover:shadow-xl">
                        <div class="flex w-full">
                            <div class="w-1/2 h-full">
                                <img src="{{ $item['image1'] }}" alt="Bild 1" class="object-cover w-full h-full">
                            </div>
                            <div class="w-1/2 h-full">
                                <img src="{{ $item['image2'] }}" alt="Bild 2" class="object-cover w-full h-full">
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-primary mb-1">{{ $item['title'] }}</h3>
                            <p class="text-gray-600 text-sm">{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>--}}

            {{-- Reference Tiles – Einzelkacheln je Bild --}}
            <div class="max-w-6xl mx-auto grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 text-left">
                @php
                    $items = [
                        ['image' => '/images/slider/Bau eines Zauns.jpg', 'title' => 'Zaunbau', 'text' => 'Gerader Zaun mit Pforte – solide montiert und langlebig.'],
                        ['image' => '/images/slider/Hecken rückschneiden.jpg', 'title' => 'Heckenrückschnitt', 'text' => 'Gepflegte Hecken für ein aufgeräumtes Gesamtbild.'],

                        ['image' => '/images/slider/Rasen vertikutieren.jpg', 'title' => 'Rasenpflege', 'text' => 'Rasen vertikutieren für dichte und gesunde Grünflächen.'],
                        ['image' => '/images/slider/Dach reinigen.jpg', 'title' => 'Dachreinigung', 'text' => 'Sauberes Dach für bessere Optik und längere Haltbarkeit.'],

                        ['image' => '/images/slider/Schornstein ausleeren.jpg', 'title' => 'Schornstein ausleeren', 'text' => 'Sichere Reinigung und Entleerung von Schornsteinen.'],
                        ['image' => '/images/slider/Lampen anbauen.jpg', 'title' => 'Lampen montieren', 'text' => 'Neue Beleuchtung schnell und sicher installiert.'],

                        ['image' => '/images/slider/Neue Türen samt Zargen einbauen.jpg', 'title' => 'Türen einbauen', 'text' => 'Moderne Türen samt Zargen – fachgerecht eingebaut.'],
                        ['image' => '/images/slider/Silikonfugen erneuern.jpg', 'title' => 'Silikonfugen erneuern', 'text' => 'Für dichte und hygienische Anschlussfugen.'],

                        ['image' => '/images/slider/Dachrinnen reinigen.jpg', 'title' => 'Dachrinne reinigen', 'text' => 'Laubfrei für optimalen Wasserabfluss.'],
                        ['image' => '/images/slider/Garten erneuern.jpg', 'title' => 'Garten neu gestalten', 'text' => 'Gartenpflege und Neugestaltung aus einer Hand.'],

                        ['image' => '/images/slider/Hof mit Hochdruckreiniger säubern.jpg', 'title' => 'Hofreinigung', 'text' => 'Mit Hochdruck für ein sauberes Umfeld.'],
                        ['image' => '/images/slider/Garageneinfahrt neu pflastern.jpg', 'title' => 'Einfahrt pflastern', 'text' => 'Robuste und saubere Garageneinfahrten neu verlegt.'],

                        ['image' => '/images/slider/Badezimmer bauen.jpg', 'title' => 'Badezimmerbau', 'text' => 'Modernes Bad für mehr Wohnkomfort.'],
                        ['image' => '/images/slider/Tapezieren der Wände.jpg', 'title' => 'Wände tapezieren', 'text' => 'Neue Tapeten für frischen Wohnstil.'],

                        ['image' => '/images/slider/Boden neu verlegen.jpg', 'title' => 'Boden verlegen', 'text' => 'Neuer Boden – fachgerecht und sauber verlegt.'],
                        ['image' => '/images/slider/Lampen und Steckdosen anbringen.jpg', 'title' => 'Elektrik installieren', 'text' => 'Sichere Elektroinstallationen für Wohn- und Arbeitsräume.'],

                        ['image' => '/images/slider/Fassaden reinigen.jpg', 'title' => 'Fassade reinigen', 'text' => 'Frischer Look durch saubere Fassadenflächen.'],
                        ['image' => '/images/slider/Trockenbauarbeiten.jpg', 'title' => 'Trockenbau', 'text' => 'Flexible Raumaufteilung und moderne Wandlösungen.'],

                        ['image' => '/images/slider/Giebelwand dämmen.jpg', 'title' => 'Giebelwand dämmen', 'text' => 'Wärmeschutz verbessern durch fachgerechte Dämmung.'],
                        ['image' => '/images/slider/Rückbau Küche.jpg', 'title' => 'Küche zurückbauen', 'text' => 'Rückbau alter Küchen für neue Gestaltungsmöglichkeiten.'],

                        [
                            'image' => '/images/slider/Neue Elektrik verlegen.jpg',
                            'title' => 'Elektrik verlegen',
                            'text' => 'Komplette Neuverlegung von Stromleitungen – sicher und normgerecht.'
                        ], [
                            'image' => '/images/slider/Umzug durchführen.jpg',
                            'title' => 'Umzugshilfe',
                            'text' => 'Effizienter Umzug – Möbel, Kartons und Montage aus einer Hand.'
                        ], [
                            'image' => '/images/slider/Neue Pflanzen einpflanzen.jpg',
                            'title' => 'Pflanzen einsetzen',
                            'text' => 'Neue Pflanzen fachgerecht eingepflanzt für blühende Gärten.'
                        ], [
                            'image' => '/images/slider/Hof fegen.jpg',
                            'title' => 'Hof kehren',
                            'text' => 'Gründliche Hofreinigung für ein gepflegtes Erscheinungsbild.'
                        ],

                    ];
                @endphp

                @foreach ($items as $index => $item)
                    <div class="reference-tile {{ $index > 5 ? 'hidden opacity-0 scale-95' : 'opacity-100 scale-100' }} transition-all duration-500">
                        <div class="flex flex-col h-full bg-white rounded-xl shadow-md overflow-hidden transform transition duration-300 ease-in-out hover:-translate-y-2 hover:scale-105 hover:shadow-xl">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="object-cover w-full h-48">
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <h3 class="text-lg font-semibold text-primary mb-1">{{ $item['title'] }}</h3>
                                <p class="text-gray-600 text-sm">{{ $item['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Buttons -->
            <div class="text-center mt-6">
                <button id="load-more-btn" class="bg-primary mt-8 inline-block text-white font-semibold py-3 px-8 rounded-lg hover:bg-primary-dark transition">
                    Mehr laden...
                </button>

                <button id="show-less-btn" class="bg-primary mt-8 hidden text-white font-semibold py-3 px-8 rounded-lg hover:bg-primary-dark transition">
                    Weniger anzeigen
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const tiles = document.querySelectorAll('.reference-tile');
                    const loadMoreBtn = document.getElementById('load-more-btn');
                    const showLessBtn = document.getElementById('show-less-btn');
                    const reference = document.getElementById('reference');
                    const initialVisible = 6;
                    let visibleCount = initialVisible;

                    function showTiles(count) {
                        tiles.forEach((tile, index) => {
                            if (index < count) {
                                tile.classList.remove('hidden');
                                setTimeout(() => {
                                    tile.classList.add('opacity-100', 'scale-100');
                                    tile.classList.remove('opacity-0', 'scale-95');
                                }, 10); // kleiner Delay für Transition
                            }
                        });
                    }

                    function hideTiles(fromIndex) {
                        tiles.forEach((tile, index) => {
                            if (index >= fromIndex) {
                                tile.classList.add('opacity-0', 'scale-95');
                                tile.classList.remove('opacity-100', 'scale-100');
                                setTimeout(() => {
                                    tile.classList.add('hidden');
                                }, 400); // Zeit für die Animation (muss mit CSS duration matchen)
                            }
                        });
                    }

                    loadMoreBtn.addEventListener('click', function () {
                        let nextVisible = visibleCount + 3;
                        showTiles(nextVisible);
                        visibleCount = nextVisible;

                        if (visibleCount >= tiles.length) {
                            loadMoreBtn.classList.add('hidden');
                            showLessBtn.classList.remove('hidden');
                        }
                    });

                    showLessBtn.addEventListener('click', function () {
                        hideTiles(initialVisible);
                        visibleCount = initialVisible;
                        showLessBtn.classList.add('hidden');
                        loadMoreBtn.classList.remove('hidden');

                        // Nach oben zur Referenz scrollen
                        setTimeout(() => {
                            reference.scrollIntoView({ behavior: 'smooth' });
                        }, 300);
                    });
                });
            </script>



        </section>

        <!-- Applications Section -->
        <section id="application" class="bg-gray-50 py-16 px-6 md:px-12">
            <div class="max-w-7xl mx-auto text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Du willst echte Teamarbeit erleben?</h2>
                <p class="text-lg text-gray-700 max-w-2xl mx-auto">
                    Werde Teil unseres Teams – wir freuen uns auf deine Bewerbung!
                </p>
                <a href="mailto:info@felix-machts.com"
                   class="mt-6 inline-block bg-primary text-white font-semibold py-3 px-6 rounded-lg hover:bg-primary-dark transition">
                    Jetzt bewerben
                </a>
            </div>

            <div class="max-w-6xl mx-auto">
                @php
                    $roles = [
                        ['title' => 'Hausmeister', 'tasks' => ['Gebäudebetreuung', 'Kleinreparaturen', 'Winterdienst']],
                        ['title' => 'Handwerker', 'tasks' => ['Elektroarbeiten', 'Reparaturen', 'Wartung']],
                        ['title' => 'Abteilungsleitung', 'tasks' => ['Planung', 'Teamführung', 'Qualitätskontrolle']],
                        ['title' => 'Assistenz', 'tasks' => ['Organisation', 'Kommunikation', 'Terminmanagement']],
                        ['title' => 'Marketing', 'tasks' => ['Social Media', 'Content', 'Werbung']],
                        ['title' => 'Vertrieb', 'tasks' => ['Kundenberatung', 'Angebote', 'Verkauf']],
                        ['title' => 'Buchhaltung', 'tasks' => ['Rechnungen', 'Kontenpflege', 'Finanzen']],
                        ['title' => 'HR', 'tasks' => ['Recruiting', 'Personalpflege', 'Entwicklung']],
                    ];
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-left">
                    @foreach ($roles as $role)
                        <div class="bg-white rounded-xl shadow p-4 transition duration-300 ease-in-out transform hover:-translate-y-2 hover:scale-105 hover:shadow-xl">
                            <h3 class="text-base font-semibold text-primary mb-1">{{ $role['title'] }}</h3>
                            <ul class="list-disc list-inside text-gray-700 text-sm space-y-0.5">
                                @foreach ($role['tasks'] as $task)
                                    <li>{{ $task }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>



        </section>

        {{--Contact Section--}}
        @livewire('global.widgets.contact-form')

    </x-sections.page-container>

</x-layouts.frontend_layout>
