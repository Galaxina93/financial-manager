{{--
    Vollständige Blade-Datei für die FinancialManager Komponente.
    - Namespace: App\Livewire\Admin
    - View: livewire.widgets.financial-manager
    - FIX: .prevent-Modifikator zu wire:keydown.enter hinzugefügt, um GET-Anfragen zu verhindern.
--}}
<div class="container mx-auto p-4 md:p-6 lg:p-8 space-y-8 font-sans">

    <!-- #region Flash Messages (Toast Notifications) -->
    <div x-data="{ show: false, message: '', type: '' }"
         @flash-message.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 5000)"
         x-show="show"
         x-transition:enter="transform ease-out duration-300 transition"
         x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
         x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed top-5 right-5 z-50 max-w-sm w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
         :class="{
            'border-l-4 border-green-500': type === 'success',
            'border-l-4 border-red-500': type === 'danger',
            'border-l-4 border-blue-500': type === 'info',
            'border-l-4 border-yellow-500': type === 'warning'
         }">
        <div class="p-4">
            <div class="flex items-start">
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="message"></p>
                </div>
                <div class="ml-4 flex-shrink-0 flex">
                    <button @click="show = false" class="inline-flex text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- #endregion -->

    <!-- #region HAUPTFORMULAR: SONDERAUSGABE ERFASSEN -->
    <div x-data="{ formVisible: false }"
         class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">

        <!-- Kopfbereich bleibt immer sichtbar -->
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-2 text-center">
            ⚡ Schnellerfassung Sonderausgabe
        </h2>
        <div class="text-center mb-6">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Aktuell über {{ $this->quickViewSummary['monthName'] }}
            </p>
            <p class="text-4xl font-bold my-2 {{ $this->quickViewSummary['currentMonthBalance'] < 0 ? 'text-red-500' : 'text-green-500' }}">
                {{ number_format($this->quickViewSummary['currentMonthBalance'], 2, ',', '.') }} €
            </p>
            <div class="flex justify-center gap-6 text-sm">
            <span class="text-gray-600 dark:text-gray-300">
                Gesamt:
                <span class="font-semibold {{ $this->quickViewSummary['totalBalance'] < 0 ? 'text-red-500' : 'text-green-500' }}">
                    {{ number_format($this->quickViewSummary['totalBalance'], 2, ',', '.') }} €
                </span>
            </span>
                <span class="text-gray-600 dark:text-gray-300">
                Ausgaben:
                <span class="font-semibold text-red-500">
                    {{ number_format($this->quickViewSummary['currentMonthExpenses'], 2, ',', '.') }} €
                </span>
            </span>
            </div>
        </div>

        <!-- Immer sichtbarer Button -->
        <div class="flex justify-center mb-4">
            <button @click="formVisible = !formVisible"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-lg">
                Sonderbetrag hinzufügen
                <span x-text="formVisible ? ' ▲' : ' ▼'"></span>
            </button>
        </div>

        <!-- Formular: nur sichtbar wenn formVisible -->
        <div x-show="formVisible" x-transition>
            <hr class="border-gray-200 dark:border-gray-700 my-6">

            <form wire:submit="submitSpecialIssue" class="flex flex-col items-center">
                <div class="w-full max-w-2xl grid grid-cols-1 gap-6">
                    <div>
                        <label for="what" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Was? (Beschreibung)</label>
                        <input type="text" id="what" wire:model.blur="what" placeholder="z.B. neues Smartphone, Restaurantbesuch"
                               class="mt-1 block w-full rounded-md border-2 border-gray-400 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-3">
                        @error('what') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Betrag (€)</label>
                        <input type="number" step="0.01" id="price" wire:model.blur="price" placeholder="-29.99"
                               class="mt-1 block w-full rounded-md border-2 border-gray-400 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-3">
                        @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="where" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Wo?</label>
                        <input type="text" id="where" wire:model.blur="where" placeholder="z.B. Supermarkt, Amazon"
                               class="mt-1 block w-full rounded-md border-2 border-gray-400 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-3">
                        @error('where') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="when" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Wann?</label>
                        <input type="date" id="when" wire:model.blur="when"
                               class="mt-1 block w-full rounded-md border-2 border-gray-400 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-3">
                        @error('when') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="why" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategorie</label>
                        <select id="why" wire:model="why"
                                class="mt-1 block w-full rounded-md border-2 border-gray-400 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg p-3">
                            @forelse($this->initialCategories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @empty
                                <option disabled>Bitte erst eine Kategorie anlegen!</option>
                            @endforelse
                        </select>
                        @error('why') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                                class="w-full sm:w-auto flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-lg">
                            <svg wire:loading wire:target="submitSpecialIssue"
                                 class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Erfassen
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- #endregion -->



    <hr class="my-6 border-gray-200 dark:border-gray-700">

    <!-- #region ICON-TOOLBAR ZUM UMSCHALTEN DER SEKTIONEN -->
    <div class="flex flex-wrap gap-3 justify-center">
        @php
            $iconClass = 'flex flex-col items-center justify-center w-28 h-24 p-2 rounded-lg cursor-pointer transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500';
            $activeClass = 'bg-indigo-600 text-white shadow-lg';
            $inactiveClass = 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700';
        @endphp
        <div wire:click="toggleSection('showSpecialIssuesTable')" class="{{ $iconClass }} {{ $showSpecialIssuesTable ? $activeClass : $inactiveClass }}">
            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
            <span class="text-xs font-semibold">Ausgaben</span>
        </div>
        <div wire:click="toggleSection('showYearlySummary')" class="{{ $iconClass }} {{ $showYearlySummary ? $activeClass : $inactiveClass }}">
            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="text-xs font-semibold">Jahresübersicht</span>
        </div>
        <div wire:click="toggleSection('showChart')" class="{{ $iconClass }} {{ $showChart ? $activeClass : $inactiveClass }}">
            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
            <span class="text-xs font-semibold">Chart</span>
        </div>
        <div wire:click="toggleSection('showCategoryManager')" class="{{ $iconClass }} {{ $showCategoryManager ? $activeClass : $inactiveClass }}">
            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 8v5c0 1.1.9 2 2 2h.5a.5.5 0 00.5-.5V8.5a.5.5 0 01.5-.5H5a2 2 0 012-2v-.5a.5.5 0 00-.5-.5H6a.5.5 0 01-.5-.5V7z"></path></svg>
            <span class="text-xs font-semibold">Kategorien</span>
        </div>
        <div wire:click="toggleSection('showGroupManager')" class="{{ $iconClass }} {{ $showGroupManager ? $activeClass : $inactiveClass }}">
            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" ><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            <span class="text-xs font-semibold">Gruppen</span>
        </div>
    </div>
    <!-- #endregion -->

    <div class="mt-8 space-y-8">

        <!-- #region SEKTION: TABELLE DER SONDERAUSGABEN -->
        @include('livewire.financial-manager.special-issues-table')
        <!-- #endregion -->

        <!-- #region SEKTION: JAHRESÜBERSICHT -->
        @include('livewire.financial-manager.yearly-summary')
        <!-- #endregion -->

        <!-- #region SEKTION: CHART -->
        @include('livewire.financial-manager.chart')
        <!-- #endregion -->

        <!-- #region SEKTION: KATEGORIE-VERWALTUNG -->
        @include('livewire.financial-manager.category-manager')
        <!-- #endregion -->

        <!-- #region SEKTION: GRUPPEN-VERWALTUNG -->
        @include('livewire.financial-manager.group-manager')
        <!-- #endregion -->

    </div>
</div>
