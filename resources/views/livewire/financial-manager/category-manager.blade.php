<div x-show="$wire.showCategoryManager" x-collapse>
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Kategorien verwalten</h3>
            <button wire:click="createCategory" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-sm">+ Neue Kategorie</button>
        </div>
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($this->categories as $category)
                <li wire:key="category-{{ $category->id }}" class="py-2 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 px-2 rounded-md">
                    <div class="flex-grow mr-4">
                        <input type="text" value="{{ $category->name }}"
                               wire:change="updateCategoryName({{ $category->id }}, $event.target.value)"
                               class="w-full bg-transparent border-none focus:ring-1 focus:ring-indigo-500 rounded p-1 text-gray-800 dark:text-gray-200">
                    </div>
                    <div class="flex-shrink-0">
                        @if($confirmingCategoryDeletion === $category->id)
                            <button wire:click="deleteCategory({{ $category->id }})" class="text-red-600 hover:text-red-900 font-bold">Löschen?</button>
                            <button wire:click="$set('confirmingCategoryDeletion', null)" class="text-gray-500 hover:text-gray-700 ml-2">Nein</button>
                        @else
                            <button wire:click="$set('confirmingCategoryDeletion', {{ $category->id }})" class="text-red-600 hover:text-red-900 font-semibold">Löschen</button>
                        @endif
                    </div>
                </li>
            @empty
                <li class="py-4 text-center text-gray-500 dark:text-gray-400">Keine Kategorien gefunden.</li>
            @endforelse
        </ul>
    </div>
</div>
