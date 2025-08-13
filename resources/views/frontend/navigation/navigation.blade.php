<div class="mx-auto pt-6">
    <!-- Navigation -->
    <nav class="bg-primary shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-2">
                        <img src="{{ URL::to('/images/logo/felix_logo.png') }}" alt="Felix Machts Logo" class="h-10">
                    </a>
                </div>

                <!-- Desktop Menü -->
                <div class="hidden md:block">
                    @if (Request::is('datenschutz') || Request::is('impressum') || Request::is('calculator'))
                        <div class="ml-10 flex items-baseline space-x-8">
                            <a href="/" class="text-white font-semibold hover:underline transition-colors">← Zurück zur Startseite</a>
                        </div>
                    @else
                        <div class="ml-10 flex items-baseline space-x-8">
                            <a href="#home" class="text-white hover:text-gray-900 transition-colors">Startseite</a>
                            <a href="#services" class="text-white hover:text-gray-900 transition-colors">Leistungen</a>
                            {{--<a href="#portfolio" class="text-white hover:text-gray-900 transition-colors">Portfolio</a>--}}
                            <a href="#about" class="text-white hover:text-gray-900 transition-colors">Über uns</a>
                            <a href="#process" class="text-white hover:text-gray-900 transition-colors">Ablauf</a>
                            <a href="#reference" class="text-white hover:text-gray-900 transition-colors">Referenzen</a>
                            <a href="#application" class="text-white hover:text-gray-900 transition-colors">Bewerbung</a>
                            <a href="#contact" class="text-white hover:text-gray-900 transition-colors">Kontakt</a>
                        </div>
                    @endif
                </div>

                <!-- Mobile Toggle Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-white hover:text-gray-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @if (Request::is('calculator'))
                    <a href="/" class="block px-3 py-2 text-primary font-semibold">← Zurück zur Startseite</a>
                @else
                    <a href="#home" class="block px-3 py-2 text-gray-700 hover:text-primary">Startseite</a>
                    <a href="#services" class="block px-3 py-2 text-gray-700 hover:text-primary">Leistungen</a>
                    {{--<a href="#portfolio" class="block px-3 py-2 text-gray-700 hover:text-primary">Portfolio</a>--}}
                    <a href="#about" class="block px-3 py-2 text-gray-700 hover:text-primary">Über uns</a>
                    <a href="#process" class="block px-3 py-2 text-gray-700 hover:text-primary">Ablauf</a>
                    <a href="#reference" class="block px-3 py-2 text-gray-700 hover:text-primary">Referenzen</a>
                    <a href="#application" class="block px-3 py-2 text-gray-700 hover:text-primary">Bewerbung</a>
                    <a href="#contact" class="block px-3 py-2 text-gray-700 hover:text-primary">Kontakt</a>
                @endif
            </div>
        </div>
    </nav>
</div>
