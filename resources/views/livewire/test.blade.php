<div>
    Saya Berada di Halaman Livewire

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <div class="my-4">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                wire:click="create">Add Post</button>
                        </div>
                        @if ($isOpen)
                            <div class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="absolute inset-0 bg-black opacity-50"></div>
                                <div class="relative bg-gray-200 p-8 rounded shadow-lg w-1/2">
                                    <!-- Modal content goes here -->
                                    <svg wire:click.prevent="$set('isOpen', false)"
                                        class="ml-auto w-6 h-6 text-gray-900 dark:text-gray-900 cursor-pointer fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                        <path
                                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                                    </svg>
                                    <h2 class="text-2xl font-bold mb-4">Create Post</h2>
                                    <form>
                                        <div class="mb-4">
                                            <label for="title"
                                                class="block text-gray-700 font-bold mb-2">Title:</label>
                                            <input type="text" id="title"
                                                class="w-full border border-gray-300 px-4 py-2 rounded">
                                        </div>
                                        <div class="mb-4">
                                            <label for="body"
                                                class="block text-gray-700 font-bold mb-2">Body:</label>
                                            <textarea id="body" rows="4" class="w-full border border-gray-300 px-4 py-2 rounded"></textarea>
                                        </div>
                                        <div class="flex justify-end">

                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Save</button>
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                                wire:click="closeModal">Cancel</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
