<div
    x-data="{
        message: '',
        showNotification: false
    }"
    x-on:notify.window="message = $event.detail.message; showNotification = true; setTimeout(() => showNotification = false, 4000)"
    class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow space-y-6"
>
    <!-- Notification -->
    <div aria-live="polite" class="h-0">
        <div x-show="showNotification" x-transition class="fixed top-5 right-5 z-50 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded shadow-lg">
            <span x-text="message"></span>
        </div>
    </div>

    <!-- Header -->
    <div>
        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Verzeichnisverwaltung</h3>
        <p class="text-base text-gray-600 dark:text-gray-300">Erstellen, verwalten und befüllen Sie freigegebene Verzeichnisse.</p>
    </div>

    <!-- Directory List & Create New -->
    <div class="space-y-4">
        <h4 class="font-semibold dark:text-white">Bestehende Freigaben</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($directories as $directory)
                <div class="p-4 rounded-lg shadow-sm flex flex-col justify-between @if($selectedDirectory?->id === $directory->id) bg-primary-50 dark:bg-primary-900/50 border border-primary @else bg-gray-50 dark:bg-gray-700 @endif" wire:key="dir-view-{{ $directory->id }}">
                    <!-- Viewing State -->
                    @if ($editingDirectoryId !== $directory->id)
                        <div x-data="{ open: false }" x-on:click.away="open = false" class="relative">
                            <div class="flex items-center gap-2 cursor-pointer" wire:click="selectDirectory({{ $directory->id }})">
                                <span class="text-blue-500">📁</span>
                                <span class="font-medium dark:text-gray-200 truncate">{{ $directory->name }}</span>
                            </div>
                            <div class="absolute top-0 right-0">
                                <button @click="open = !open" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" /></svg>
                                </button>
                            </div>
                            <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-10 border dark:border-gray-600">
                                <a href="#" wire:click.prevent="selectDirectory({{ $directory->id }})" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Verwalten</a>
                                <a href="#" wire:click.prevent="startEditing({{ $directory->id }})" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Umbenennen</a>
                                <a href="#" wire:click.prevent="deleteDirectory({{ $directory->id }})" wire:confirm="Sind Sie sicher?" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700">Löschen</a>
                            </div>
                        </div>
                    @else
                        <!-- Editing State -->
                        <div wire:key="dir-edit-{{ $directory->id }}">
                            <input type="text" wire:model="editingDirectoryName" class="w-full block rounded-lg border-gray-300 dark:bg-gray-600 dark:border-gray-500 dark:text-white" wire:keydown.enter="updateDirectoryName" wire:keydown.escape="cancelEditing">
                            @error('editingDirectoryName') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                            <div class="flex items-center justify-end gap-2 mt-2">
                                <x-forms.button title="Abbrechen" category="secondary" wireClick="cancelEditing" />
                                <x-forms.button title="Speichern" category="primary" wireClick="updateDirectoryName" />
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500 col-span-full">Bisher wurden keine Verzeichnisse erstellt.</p>
            @endforelse

                <!-- Create New Directory Card (Updated Style) -->
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm flex flex-col justify-center">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                        <div class="w-full sm:w-auto flex-grow">
                            <input
                                type="text"
                                wire:model="newDirectoryName"
                                placeholder="Neues Verzeichnis..."
                                class="w-full block rounded-lg border border-gray-300 px-3 py-2 sm:text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                wire:keydown.enter="createDirectory"
                            >
                            @error('newDirectoryName') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div wire:loading.remove wire:target="createDirectory">
                            <x-forms.button
                                title="Erstellen"
                                category="primary"
                                wire:click="createDirectory"
                                type="button"
                                class="w-full sm:w-auto"
                            />
                        </div>
                        <div wire:loading wire:target="createDirectory">
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
        </div>
    </div>

    <!-- Management Section (Users & Files) -->
    @if ($selectedDirectory)
        <div class="mt-6 p-6 border-t dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-lg" x-transition>
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-lg font-semibold dark:text-white">Verzeichnis verwalten: "<span class="text-primary">{{ $selectedDirectory->name }}</span>"</h4>
                <button wire:click="unselectDirectory" class="text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 font-bold text-xl">&times;</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- User Assignment -->
                <div>
                    <h5 class="font-semibold mb-2 dark:text-white">Freigabe für Benutzer</h5>
                    <div class="max-h-64 overflow-y-auto pr-2 border rounded-md p-2 dark:border-gray-600">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Wählen Sie die Benutzer aus, die Zugriff haben sollen.</p>
                        <div class="space-y-1">
                            @foreach ($users as $user)
                                <label class="flex items-center p-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 cursor-pointer">
                                    <input type="checkbox" wire:model.live="assignedUsers" value="{{ $user['key'] }}" class="rounded">
                                    <span class="ml-3 dark:text-gray-200">{{ $user['name'] }} <span class="text-xs text-gray-500">({{ $user['type'] }})</span></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <x-forms.button title="Freigaben speichern" category="primary" wireClick="syncUsers" />
                    </div>
                </div>

                <!-- File Management -->
                <div class="space-y-4">
                    <h5 class="font-semibold mb-2 dark:text-white">Dateien im Verzeichnis</h5>
                    <!-- File Upload -->
                    <div class="p-4 border rounded-lg dark:border-gray-600">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Neue Dateien hochladen</label>
                        <input type="file" wire:model="uploads" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-200 dark:file:bg-gray-600 dark:file:text-white file:text-gray-700 hover:file:bg-gray-300 mt-1">
                        <div wire:loading wire:target="uploads" class="text-sm text-gray-500 mt-1">Lade hoch...</div>
                        @error('uploads.*') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        <div class="flex justify-end mt-2">
                            <x-forms.button title="Hochladen" category="primary" wireClick="uploadFiles" :disabled="empty($uploads)" />
                        </div>
                    </div>

                    <!-- File List -->
                    <div class="space-y-2 max-h-64 overflow-y-auto pr-2">
                        @forelse($files as $file)
                            <div class="flex items-center justify-between p-2 bg-white dark:bg-gray-800 rounded-md shadow-sm" wire:key="file-{{ $file['name'] }}">
                                <div class="flex items-center gap-3 truncate">
                                    @if($file['isImage'])
                                        <img src="{{ $file['url'] }}" class="w-8 h-8 object-cover rounded">
                                    @else
                                        <span class="text-xl">📄</span>
                                    @endif
                                    <span class="truncate">{{ $file['name'] }}</span>
                                </div>
                                <button wire:click="deleteFile('{{ $file['name'] }}')" class="text-red-500 hover:text-red-700">&times;</button>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 p-4">Keine Dateien in diesem Verzeichnis.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
