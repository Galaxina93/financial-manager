<div x-show="$wire.showGroupManager" x-collapse>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Gruppen & Kostenstellen</h3>
            <button wire:click="createGroup" wire:loading.attr="disabled" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-sm inline-flex items-center">
                <svg wire:loading wire:target="createGroup" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove wire:target="createGroup">+ Neue Gruppe</span>
                <span wire:loading wire:target="createGroup">Erstelle...</span>
            </button>
        </div>
        <div class="space-y-4">
            @forelse($this->groups as $group)
                <div wire:key="group-{{$group->id}}" class="border border-gray-200 dark:border-gray-700 rounded-lg">
                    <!-- Header -->
                    <div class="bg-gray-50 dark:bg-gray-700/50 p-3 flex justify-between items-center">
                        <div class="flex items-center gap-2 flex-grow">
                            <input type="text" value="{{ $group->name }}" wire:change="updateGroup({{ $group->id }}, $event.target.value)" class="font-bold text-lg bg-transparent border-none p-1 focus:ring-1 focus:ring-indigo-500 rounded w-full text-gray-800 dark:text-gray-200">
                        </div>
                        <div class="flex-shrink-0">
                            @if($confirmingGroupDeletion === $group->id)
                                <button wire:click="deleteGroup({{ $group->id }})" class="text-red-600 hover:text-red-900 font-bold">Sicher?</button>
                                <button wire:click="$set('confirmingGroupDeletion', null)" class="text-gray-500 ml-2">Nein</button>
                            @else
                                <button wire:click="createCostItem({{ $group->id }})" wire:loading.attr="disabled" class="text-sm text-indigo-600 hover:text-indigo-800 mr-4 inline-flex items-center">
                                    <svg wire:loading wire:target="createCostItem({{ $group->id }})" class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    + Kostenstelle
                                </button>
                                <button wire:click="$set('confirmingGroupDeletion', {{ $group->id }})" class="text-red-500 hover:text-red-700">Löschen</button>
                            @endif
                        </div>
                    </div>

                    <!-- NEU: Toggle Bar für Kostenstellen -->
                    <div class="px-4 pt-2 pb-4 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex items-center justify-between bg-blue-50 dark:bg-blue-900/50 rounded-lg px-4 py-2 border-l-4 border-blue-500">
                            <div class="text-gray-800 dark:text-white font-medium">
                                Kostenstellen:
                                <span class="font-semibold">{{ count($group->costItems) }}</span>
                            </div>
                            <button wire:click="toggleGroupDetails({{ $group->id }})" title="Kostenstellen anzeigen/verbergen">
                                <svg class="w-6 h-6 text-blue-600 hover:text-blue-800 dark:hover:text-blue-400 transition-transform duration-300" :class="{'rotate-180': {{ in_array($group->id, $openGroups) ? 'true' : 'false' }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Body (Cost Items) -->
                    <div x-show="@json(in_array($group->id, $openGroups))" x-collapse class="px-4 pb-4 -mt-4 space-y-3">
                        @forelse($group->costItems as $item)
                            <div wire:key="item-{{$item->id}}" class="border-l-4 border-indigo-200 pl-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-900/20 rounded-r-md">
                                <!-- Desktop View for Cost Item -->
                                <div class="hidden md:flex justify-between items-center">
                                    <div class="flex items-center gap-4">
                                        <input type="text" value="{{ $item->name }}" wire:change="updateCostItem({{ $item->id }}, 'name', $event.target.value)" class="font-semibold bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1">
                                        <input type="number" step="0.01" value="{{ $item->amount }}" wire:change="updateCostItem({{ $item->id }}, 'amount', $event.target.value)" class="w-24 text-right bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1">
                                        <select wire:change="updateCostItemBillingType({{ $item->id }}, $event.target.value)" class="bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1">
                                            @foreach(['monthly', 'quarterly', 'yearly', 'once'] as $type)
                                                <option value="{{ $type }}" @if($item->billing_type == $type) selected @endif>{{ ucfirst($type) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <button wire:click="toggleCostItemDetails({{ $item->id }})" class="text-sm text-gray-500 hover:text-gray-800 mr-4">Details</button>
                                        @if($confirmingCostItemDeletion === $item->id)
                                            <button wire:click="deleteCostItem({{ $item->id }})" class="text-red-600 hover:text-red-900 font-bold">Sicher?</button>
                                            <button wire:click="$set('confirmingCostItemDeletion', null)" class="text-gray-500 ml-2">Nein</button>
                                        @else
                                            <button wire:click="$set('confirmingCostItemDeletion', {{ $item->id }})" class="text-red-500 hover:text-red-700">Löschen</button>
                                        @endif
                                    </div>
                                </div>
                                <!-- Mobile Card View for Cost Item -->
                                <div class="md:hidden space-y-2">
                                    <div class="flex justify-between items-center">
                                        <input type="text" value="{{ $item->name }}" wire:change="updateCostItem({{ $item->id }}, 'name', $event.target.value)" class="font-semibold text-lg bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1 w-full">
                                        @if($confirmingCostItemDeletion === $item->id)
                                            <div>
                                                <button wire:click="deleteCostItem({{ $item->id }})" class="text-red-600 hover:text-red-900 font-bold">Sicher?</button>
                                                <button wire:click="$set('confirmingCostItemDeletion', null)" class="text-gray-500 ml-2">Nein</button>
                                            </div>
                                        @else
                                            <button wire:click="$set('confirmingCostItemDeletion', {{ $item->id }})" class="text-red-500 hover:text-red-700">Löschen</button>
                                        @endif
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <input type="number" step="0.01" value="{{ $item->amount }}" wire:change="updateCostItem({{ $item->id }}, 'amount', $event.target.value)" class="w-24 text-right bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1">
                                        <select wire:change="updateCostItemBillingType({{ $item->id }}, $event.target.value)" class="bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1">
                                            @foreach(['monthly', 'quarterly', 'yearly', 'once'] as $type)
                                                <option value="{{ $type }}" @if($item->billing_type == $type) selected @endif>{{ ucfirst($type) }}</option>
                                            @endforeach
                                        </select>
                                        <button wire:click="toggleCostItemDetails({{ $item->id }})" class="text-sm text-gray-500 hover:text-gray-800">Details</button>
                                    </div>
                                </div>
                                <!-- Contract Details (collapsible) -->
                                <div x-show="@json(in_array($item->id, $openCostItems))" x-collapse class="mt-4 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-md grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @if($item->contract)
                                        <h4 class="col-span-1 sm:col-span-2 font-semibold text-gray-700 dark:text-gray-300">Vertragsdetails</h4>
                                        <input type="text" placeholder="Vertragsnr." value="{{ $item->contract->contract_number }}" wire:change="updateContract({{ $item->contract->id }}, 'contract_number', $event.target.value)" class="w-full text-sm rounded-md border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                                        <input type="text" placeholder="Ansprechpartner" value="{{ $item->contract->name }}" wire:change="updateContract({{ $item->contract->id }}, 'name', $event.target.value)" class="w-full text-sm rounded-md border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                                        <input type="email" placeholder="E-Mail" value="{{ $item->contract->email }}" wire:change="updateContract({{ $item->contract->id }}, 'email', $event.target.value)" class="w-full text-sm rounded-md border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                                        <input type="text" placeholder="Telefon" value="{{ $item->contract->phone }}" wire:change="updateContract({{ $item->contract->id }}, 'phone', $event.target.value)" class="w-full text-sm rounded-md border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                                    @else
                                        <p class="col-span-1 sm:col-span-2 text-gray-500 dark:text-gray-400">Keine Vertragsdetails vorhanden.</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 pl-4">Keine Kostenstellen in dieser Gruppe.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-400 py-4">Keine Gruppen vorhanden.</p>
            @endforelse
        </div>
    </div>
</div>
