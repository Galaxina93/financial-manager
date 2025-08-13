<x-layouts.frontend_layout>
    <x-sections.page-container>

        <section class="bg-white py-16 sm:py-20 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">

                <!-- Header -->
                <div class="text-center mb-12 sm:mb-16">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                        Interaktiver Kalkulator für Hausmeisterservices
                    </h2>
                    <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto">
                        Unser Kalkulator ermöglicht Ihnen eine maßgeschneiderte Zusammenstellung Ihres individuellen Hausmeisterservices – transparent, benutzerfreundlich und jederzeit verfügbar.
                    </p>

                </div>

                <!-- Ablaufschema -->
                <div class="bg-gray-50 px-6 py-10 sm:p-12 rounded-xl shadow-inner mb-20">
                    <h3 class="text-xl sm:text-2xl font-bold text-center text-gray-900 mb-10">So funktioniert's</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 text-center">
                        <div>
                            <div class="text-pink-600 text-2xl sm:text-3xl mb-3">
                                <i class="fas fa-mouse-pointer"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">1. Leistungen wählen</h4>
                            <p class="text-sm sm:text-base text-gray-600">Klicken Sie auf die gewünschten Bereiche, um diese in Ihre Kalkulation aufzunehmen.</p>
                        </div>
                        <div>
                            <div class="text-pink-600 text-2xl sm:text-3xl mb-3">
                                <i class="fas fa-sliders-h"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">2. Daten eingeben</h4>
                            <p class="text-sm sm:text-base text-gray-600">Anzahl Stufen, m², Häufigkeit – geben Sie einfach alle relevanten Werte ein.</p>
                        </div>
                        <div>
                            <div class="text-pink-600 text-2xl sm:text-3xl mb-3">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-2">3. Ergebnis erhalten</h4>
                            <p class="text-sm sm:text-base text-gray-600">Sehen Sie Ihre Kosten live – und senden Sie bei Bedarf direkt eine Anfrage.</p>
                        </div>
                    </div>
                </div>

                <!-- Kalkulator Livewire-Komponente -->
                <div class="my-16 sm:mt-20">
                    @livewire('global.widgets.calculator')
                </div>

            </div>
        </section>

    </x-sections.page-container>
</x-layouts.frontend_layout>
