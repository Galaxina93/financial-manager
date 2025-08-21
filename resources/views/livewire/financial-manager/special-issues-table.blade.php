<div x-show="$wire.showSpecialIssuesTable" x-collapse>
    <div class="bg-white dark:bg-gray-800 p-4 md:p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Alle Sonderausgaben</h3>
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Suche in allen Ausgaben..." class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 shadow-sm mb-4">

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Was</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Wo</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Betrag</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kategorie</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aktion</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($this->specialIssues as $issue)
                    <tr wire:key="desktop-issue-{{ $issue->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-4 py-2 text-sm"><input type="text" value="{{ $issue->what }}" wire:change="updateSpecialIssue({{ $issue->id }}, 'what', $event.target.value)" class="w-full bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1"></td>
                        <td class="px-4 py-2 text-sm"><input type="text" value="{{ $issue->where }}" wire:change="updateSpecialIssue({{ $issue->id }}, 'where', $event.target.value)" class="w-full bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1"></td>
                        <td class="px-4 py-2 text-sm"><input type="number" step="0.01" value="{{ $issue->price }}" wire:change="updateSpecialIssue({{ $issue->id }}, 'price', $event.target.value)" class="w-full bg-transparent border-none text-right focus:ring-1 focus:ring-indigo-500 rounded p-1 {{ $issue->price < 0 ? 'text-red-500' : 'text-green-500' }}"></td>
                        <td class="px-4 py-2 text-sm">
                            <select wire:change="updateSpecialIssue({{ $issue->id }}, 'why', $event.target.value)" class="w-full bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1">
                                @foreach($this->categories as $category)
                                    <option value="{{ $category->name }}" @if($issue->why == $category->name) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-4 py-2 text-center">
                            @if($confirmingSpecialIssueDeletion === $issue->id)
                                <button wire:click="deleteSpecialIssue({{ $issue->id }})" class="text-red-600 hover:text-red-900 font-bold">Sicher?</button>
                                <button wire:click="$set('confirmingSpecialIssueDeletion', null)" class="text-gray-600 hover:text-gray-900 ml-2">Abbrechen</button>
                            @else
                                <button wire:click="$set('confirmingSpecialIssueDeletion', {{ $issue->id }})" class="text-gray-400 hover:text-red-600" title="Löschen"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-10 text-gray-500 dark:text-gray-400">Bisher keine Einträge vorhanden.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="grid grid-cols-1 gap-4 md:hidden">
            @forelse($this->specialIssues as $issue)
                <div wire:key="mobile-issue-{{ $issue->id }}" class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 shadow-md space-y-3">
                    <div class="flex justify-between items-start">
                        <input type="text" value="{{ $issue->what }}" wire:change="updateSpecialIssue({{ $issue->id }}, 'what', $event.target.value)" class="text-lg font-bold w-full bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1 -ml-1">
                        <input type="number" step="0.01" value="{{ $issue->price }}" wire:change="updateSpecialIssue({{ $issue->id }}, 'price', $event.target.value)" class="font-semibold w-28 text-right bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1 {{ $issue->price < 0 ? 'text-red-500' : 'text-green-500' }}">
                    </div>
                    <div>
                        <input type="text" value="{{ $issue->where }}" wire:change="updateSpecialIssue({{ $issue->id }}, 'where', $event.target.value)" class="text-sm w-full bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1 -ml-1 text-gray-500 dark:text-gray-400">
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200 dark:border-gray-600">
                        <select wire:change="updateSpecialIssue({{ $issue->id }}, 'why', $event.target.value)" class="text-sm bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1 text-gray-600 dark:text-gray-300">
                            @foreach($this->categories as $category)
                                <option value="{{ $category->name }}" @if($issue->why == $category->name) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ \Carbon\Carbon::parse($issue->when)->format('d.m.y') }}</span>
                            @if($confirmingSpecialIssueDeletion === $issue->id)
                                <button wire:click="deleteSpecialIssue({{ $issue->id }})" class="text-red-600 hover:text-red-900 font-bold">Löschen?</button>
                                <button wire:click="$set('confirmingSpecialIssueDeletion', null)" class="text-gray-600 hover:text-gray-900">Nein</button>
                            @else
                                <button wire:click="$set('confirmingSpecialIssueDeletion', {{ $issue->id }})" class="text-gray-400 hover:text-red-600" title="Löschen"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500 dark:text-gray-400">Bisher keine Einträge vorhanden.</div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $this->specialIssues->links() }}
        </div>
    </div>
</div>
