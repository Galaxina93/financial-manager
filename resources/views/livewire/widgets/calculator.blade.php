<div class="px-4 sm:px-6 lg:px-8">
    <div class="mt-10 bg-primary text-center text-white p-6 sm:p-8 rounded-2xl shadow-lg">
        <p class="text-lg sm:text-xl font-medium mb-4">Nutzen Sie unseren <strong>Online-Preisrechner</strong>.</p>
        <button
            wire:click="startCalculator"
            class="inline-block bg-white text-primary font-semibold px-6 py-3 rounded-full shadow hover:bg-gray-100 transition"
        >
            Macher-Kalkulator öffnen
        </button>

        {{-- Kalkulator --}}
        @if($showCalculator)
            <section id="kalkulator" class="my-12 py-20 bg-white">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-primary">
                    <h2 class="text-2xl sm:text-base font-bold text-center mb-6">Kostenkalkulator</h2>
                    <p class="text-center text-gray-700 mb-12"> Erhalten Sie in wenigen, klar strukturierten Schritten eine verlässliche Erst-Schätzung für
                        Ihre Hausmeister- und Pflegearbeiten per Mail als PDF.
                    </p>

                    {{-- Step 1: Leistungen auswählen --}}
                        @if($step === 1)
                        <h3 class="text-xl font-semibold mb-8 text-center">Welche Leistungen benötigen Sie?</h3>

                        <div class="space-y-6">
                            @foreach($leistungen as $leistung)
                                <div class="border rounded-xl overflow-hidden shadow">
                                    {{-- Titelkachel --}}
                                    <div
                                        wire:click="toggleService('{{ $leistung['name'] }}')"
                                        class="cursor-pointer p-5 bg-gray-50 hover:bg-gray-100 transition"
                                    >
                                        <h4 class="font-bold text-lg text-gray-900">{{ $leistung['name'] }}</h4>
                                    </div>

                                    {{-- Eingabefelder --}}
                                    @if(isset($serviceDetailsVisible[$leistung['name']]))
                                        <div class="p-6 bg-white space-y-6 text-sm">
                                            @foreach($leistung['felder'] as $feldKey => $feld)
                                                <div>
                                                    <label class="font-medium block mb-1">
                                                        {{ $feld['label'] }}: <span class="text-primary">{{ $form[$feldKey] ?? 0 }}</span>
                                                    </label>
                                                    <input
                                                        type="range"
                                                        min="{{ $feld['min'] }}"
                                                        max="{{ $feld['max'] }}"
                                                        wire:model.live="form.{{ $feldKey }}"
                                                        class="w-full accent-primary"
                                                    >
                                                    <p class="text-gray-500 mt-1">{{ $feld['info'] }}</p>
                                                </div>
                                            @endforeach
                                            <div class="text-right text-primary font-semibold">
                                                Aktuelle Kosten:
                                                {{ number_format($serviceCosts[$leistung['name']] ?? 0, 2, ',', '.') }} €
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        {{-- Gesamtkosten --}}
                        <div class="mt-10 text-center">
                            <p class="text-lg font-semibold text-gray-800">Gesamtkosten:
                                <span class="text-primary text-2xl font-bold">
                                    {{ number_format($gesamtKosten, 2, ',', '.') }} €
                                </span>
                            </p>
                            <button
                                wire:click="goNext"
                                class="mt-6 bg-primary text-white px-6 py-3 rounded-xl hover:bg-primary/80 transition"
                            >
                                Weiter zur Auswertung
                            </button>
                        </div>

                    {{-- Step 2: Zusammenfassung --}}
                    @elseif($step === 2)
                        <h3 class="text-xl font-semibold mb-6 text-center">Zusammenfassung & Kontakt</h3>

                        <div class="mb-8">
                            <h4 class="font-semibold text-lg mb-4">Ihre gewählten Leistungen:</h4>
                            <ul class="space-y-3 text-gray-700 text-sm">
                                @foreach($selectedServices as $service)
                                    <li class="border p-4 rounded bg-gray-50">
                                        <strong>{{ $service }}</strong><br>
                                        {!! $serviceSummaries[$service] ?? '' !!}
                                        <div class="text-right text-primary font-semibold mt-2">
                                            Teilkosten: {{ number_format($serviceCosts[$service] ?? 0, 2, ',', '.') }} €
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <p class="text-lg font-semibold text-center mb-6">
                            Gesamtkosten: <span class="text-primary text-2xl font-bold">{{ number_format($gesamtKosten, 2, ',', '.') }} €</span>
                        </p>

                        {{-- Kontaktformular --}}
                        <div class="bg-white rounded-2xl shadow-md p-8">
                            <h4 class="text-base md:text-2xl font-bold text-gray-900 text-center mb-8">Kontaktformular</h4>
                            <form wire:submit.prevent="submit" class="space-y-8">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Vorname</label>
                                        <input wire:model.defer="form.vorname" type="text" required class="mt-2 w-full rounded-md border-gray-300 bg-gray-50 text-gray-900 shadow-sm focus:border-primary focus:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Nachname</label>
                                        <input wire:model.defer="form.nachname" type="text" required class="mt-2 w-full rounded-md border-gray-300 bg-gray-50 text-gray-900 shadow-sm focus:border-primary focus:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">E-Mail</label>
                                        <input wire:model.defer="form.email" type="email" required class="mt-2 w-full rounded-md border-gray-300 bg-gray-50 text-gray-900 shadow-sm focus:border-primary focus:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Telefon</label>
                                        <input wire:model.defer="form.telefon" type="text" class="mt-2 w-full rounded-md border-gray-300 bg-gray-50 text-gray-900 shadow-sm focus:border-primary focus:bg-white">
                                    </div>
                                </div>

                                <div class="pt-4 flex flex-col sm:flex-row justify-center sm:items-center gap-4">
                                    <button
                                        type="submit"
                                        class="bg-primary text-white px-6 py-3 rounded-xl hover:bg-primary/80 transition"
                                        wire:loading.attr="disabled"
                                        wire:target="submitForm"
                                    >
                                        Anfrage absenden
                                    </button>

                                    <!-- Ladeanimation -->
                                    <div wire:loading wire:target="submitForm" class="flex items-center space-x-2 text-sm text-gray-700">
                                        <svg class="animate-spin h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                        </svg>
                                        <span>Lädt...</span>
                                    </div>
                                </div>

                                @if (session()->has('success'))
                                    <div class="mt-4 text-center text-green-600 font-medium">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </form>
                        </div>

                        {{-- Zurück Button --}}
                        <div class="mt-6 text-center">
                            <button
                                wire:click="goBack"
                                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition"
                            >
                                Zurück
                            </button>
                        </div>
                    @endif
                </div>
            </section>
        @endif

    </div>
</div>
