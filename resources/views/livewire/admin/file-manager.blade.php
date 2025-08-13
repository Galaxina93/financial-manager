<div
    x-data="{ message: '', show: false }"
    x-on:notify-uploaded.window="message = 'Dateien erfolgreich hochgeladen.'; show = true; setTimeout(() => show = false, 4000)"
    x-on:notify-deleted.window="message = 'Ausgewählte Elemente wurden gelöscht.'; show = true; setTimeout(() => show = false, 4000)"
    x-on:notify-folder-created.window="message = 'Ordner erfolgreich erstellt.'; show = true; setTimeout(() => show = false, 4000)"
    class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"
>

    {{-- h1 & User select --}}
    <div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">

            <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Dateienmanager</h3>

            {{-- User selector --}}
            <div class="flex items-center gap-3">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Benutzer wählen</label>

                <select wire:model.live="selectedUser" wire:change="selectedUserChanged" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white min-w-[200px]">
                    @foreach ($users as $user)
                        <option value="{{ $user['key'] }}">{{ $user['name'] }} ({{ $user['type'] }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <p class="text-base text-gray-800 dark:text-white">
            Verwalten Sie die Ordner und Dateien eines ausgewählten Benutzers.
        </p>
    </div>


    {{-- Messages --}}
    <div
        class="h-0"
        aria-live="polite"
    >
        <div
            x-show="true"
            x-bind:class="{ 'opacity-100': show, 'opacity-0': !show, 'h-auto py-2': show, 'py-0': !show }"
            class="h-10 transition-all duration-500 ease-in-out overflow-hidden text-sm bg-green-100 border border-green-300 text-green-800 px-4 rounded w-fit"
        >
            <span x-text="message"></span>
        </div>
    </div>

    {{-- Folders --}}
    <div class="grid grid-cols-2 mt-8 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @foreach ($folders as $folder)
            <div
                class="p-4 bg-gray-100 dark:bg-gray-700 rounded relative group hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer"
                wire:click="goToFolder('{{ $folder }}')"
            >
                📁 {{ $folder }}

                <div x-on:click.stop class="absolute top-1 right-1">
                    <div wire:loading.remove wire:target="deleteFolder('{{ $folder }}')">
                        <x-forms.button
                            title="x"
                            category="x"
                            wire:click="deleteFolder('{{ $folder }}')"
                            wire:confirm="Möchten Sie den Ordner '{{ $folder }}' und seinen gesamten Inhalt wirklich löschen?"
                            type="button"
                            class="group-hover:inline-block"
                        />
                    </div>

                    <div wire:loading wire:target="deleteFolder('{{ $folder }}')" class="p-1">
                        <svg class="w-4 h-4 animate-spin text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                        </svg>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Create New Folder Section -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
            <div class="w-full sm:w-auto flex-grow">
                <input
                    type="text"
                    wire:model="newFolderName"
                    placeholder="Neuer Ordnername"
                    class="w-full block rounded-lg border border-gray-300 px-3 py-2 sm:text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    wire:keydown.enter="createNewFolder"
                >
                @error('newFolderName') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>
            <div wire:loading.remove wire:target="createNewFolder">
                <x-forms.button
                    title="Erstellen"
                    category="primary"
                    wire:click="createNewFolder"
                    type="button"
                    class="w-full sm:w-auto"
                />
            </div>
            <div wire:loading wire:target="createNewFolder">
                <x-forms.button
                    title="Erstelle..."
                    category="primary"
                    disabled
                    type="button"
                    class="w-full sm:w-auto"
                />
            </div>
        </div>
    </div>

    {{-- Actions: File Path, Search, Delete --}}
    <div class="space-y-4 mt-8">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="text-md text-gray-600 dark:text-gray-300 font-mono truncate w-full">
                Pfad: files{{ $this->getRelativePath() ?: '/' }}
            </div>

            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Dateien suchen..."
                class="w-full block rounded-lg border border-gray-300 px-3 py-2 sm:text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >

            <div class="flex items-center gap-3">
                <label class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                    <input type="checkbox" wire:model.live="selectAll" wire:click="toggleSelectAll" class="rounded">
                    <span>Alle</span>
                </label>
                <x-forms.button
                    title="Löschen"
                    category="danger"
                    wire:click="deleteSelected"
                    type="button"
                    :disabled="empty($selectedFiles)"
                />
            </div>
        </div>
    </div>

    {{-- Desktop Table View --}}
    <div class="hidden md:block">
        <table class="w-full mt-4 table-auto border border-gray-200 dark:border-gray-600 text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700 text-left">
            <tr>
                <th class="p-2">Auswahl</th>
                <th class="p-2">Vorschau</th>
                <th class="p-2">Dateiname</th>
                <th class="p-2">Aktionen</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($paginatedFiles as $file)
                <tr class="border-t border-gray-200 dark:border-gray-600"
                    @class([
                        'bg-primary-50 dark:bg-primary-900/50' => in_array($file['name'], $selectedFiles),
                    ])
                >
                    {{-- Auswahl --}}
                    <td class="p-2">
                        <input type="checkbox" wire:model.live="selectedFiles" value="{{ $file['name'] }}" class="rounded">
                    </td>

                    {{-- Vorschau --}}
                    <td class="p-2">
                        @if ($file['isImage'])
                            <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        @endif
                    </td>

                    {{-- Dateiname --}}
                    <td class="p-2">
                        <span class="break-all">{{ $file['name'] }}</span>
                    </td>

                    {{-- Aktionen --}}
                    <td class="p-2">
                        <div wire:loading.remove wire:target="deleteFile('{{ $file['name'] }}')">
                            <x-forms.button
                                title="✕"
                                category="x"
                                wire:click="deleteFile('{{ $file['name'] }}')"
                                wire:confirm="Möchten Sie die Datei '{{ $file['name'] }}' wirklich löschen?"
                                type="button"
                            />
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">Keine Dateien gefunden.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile Grid View --}}
    <div class="grid grid-cols-2 gap-4 mt-4 md:hidden">
        @forelse ($paginatedFiles as $file)
            <div
                class="relative p-4 bg-gray-100 dark:bg-gray-700 rounded shadow hover:bg-gray-200 dark:hover:bg-gray-600"
                @class([
                    'bg-primary-50 dark:bg-primary-900/50' => in_array($file['name'], $selectedFiles),
                ])
            >
                {{-- Checkbox --}}
                <div class="absolute top-2 left-2 z-10">
                    <input type="checkbox" wire:model.live="selectedFiles" value="{{ $file['name'] }}" class="rounded">
                </div>

                {{-- Vorschau --}}
                <div class="flex justify-center items-center mb-2">
                    @if ($file['isImage'])
                        <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" class="w-full h-24 object-cover rounded">
                    @else
                        <div class="text-4xl">📄</div>
                    @endif
                </div>

                {{-- Dateiname --}}
                <div class="text-sm text-center font-medium break-all">{{ $file['name'] }}</div>

                {{-- Aktionen --}}
                <div class="flex justify-center items-center mt-2">
                    <div wire:loading.remove wire:target="deleteFile('{{ $file['name'] }}')">
                        <x-forms.button
                            title="✕"
                            category="x"
                            wire:click="deleteFile('{{ $file['name'] }}')"
                            wire:confirm="Möchten Sie die Datei '{{ $file['name'] }}' wirklich löschen?"
                            type="button"
                        />
                    </div>
                    <div wire:loading wire:target="deleteFile('{{ $file['name'] }}')" class="ml-2">
                        <svg class="w-4 h-4 animate-spin text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                        </svg>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center text-gray-500">Keine Dateien gefunden.</div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $paginatedFiles->links() }}
    </div>

    {{-- Upload Files --}}
    <div class="mt-6 space-y-3">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dateien hochladen</label>
        <input type="file" wire:model="uploads" multiple class="block text-sm text-gray-500 file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-black hover:file:bg-gray-200 dark:file:bg-gray-600 dark:file:text-white dark:hover:file:bg-gray-500">

        <div wire:loading wire:target="uploads">
            <p class="text-sm text-gray-500 mt-1">Dateien werden vorbereitet...</p>
        </div>

        <x-forms.button
            title="Hochladen"
            category="primary"
            type="button"
            wire:click="uploadFiles"
            :disabled="empty($uploads)"
        />


        @error('uploads.*') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    {{-- Back Button --}}
    <div class="flex justify-between items-center gap-4">
        @if($this->getRelativePath())
            <x-forms.button
                title="Zurück"
                category="secondary"
                wireClick="goBack"
                type="button"
            />
        @endif
    </div>

</div>
