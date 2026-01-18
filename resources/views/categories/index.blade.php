<x-app-layout>
    <div class="py-12" x-data="{ 
        showModal: false, 
        isEdit: false, 
        categoryId: null,
        showDeleteModal: false,
        deleteAction: null,
        form: { name: '' },
        confirmDelete(url) {
            this.deleteAction = url;
            this.showDeleteModal = true;
        },
        actionUrl: '',
        openCreate() {
            this.isEdit = false;
            this.form.name = '';
            this.actionUrl = '{{ route('categories.store') }}';
            this.showModal = true;
        },
        openEdit(category, url) {
            this.isEdit = true;
            this.categoryId = category.id;
            this.form.name = category.name;
            this.actionUrl = url;
            this.showModal = true;
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-white mb-6">{{ __('messages.manage_categories') }}</h2>

             <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-500 bg-opacity-20 border border-green-500 text-green-300 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
             @if (session('error'))
                <div class="bg-red-500 bg-opacity-20 border border-red-500 text-red-300 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="glass-dark rounded-xl p-6 mb-6">
                <button @click="openCreate()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition mb-4">
                    + {{ __('messages.add_category') }}
                </button>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-gray-300">
                        <thead class="text-gray-400 uppercase bg-gray-700 bg-opacity-50">
                            <tr>
                                <th class="px-6 py-3">{{ __('messages.name') }}</th>
                                <th class="px-6 py-3">{{ __('messages.tasks_count') }}</th>
                                <th class="px-6 py-3 text-right">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($categories as $category)
                            <tr class="hover:bg-gray-700 hover:bg-opacity-30 transition">
                                <td class="px-6 py-4">{{ $category->name }}</td>
                                <td class="px-6 py-4">{{ $category->tasks->count() }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button @click="openEdit({{ $category }}, '{{ route('categories.update', $category) }}')" class="text-blue-400 hover:text-blue-300 font-medium">{{ __('messages.edit') }}</button>
                                    <button @click="confirmDelete('{{ route('categories.destroy', $category) }}')" class="text-red-400 hover:text-red-300 font-medium">{{ __('messages.delete') }}</button>
                                </td>
                            </tr>
                            @endforeach
                            @if($categories->isEmpty())
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">{{ __('messages.no_categories') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Create/Edit Modal -->
        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                </div>

                <div class="inline-block align-bottom bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    <form :action="actionUrl" method="POST" class="p-6">
                        @csrf
                        <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">
                        
                        <h3 class="text-lg font-medium leading-6 text-white mb-4" x-text="isEdit ? '{{ __('messages.edit_category') }}' : '{{ __('messages.create_category') }}'"></h3>
                        
                        <div class="mb-4">
                            <label class="block text-gray-400 text-sm mb-1">{{ __('messages.name') }}</label>
                            <input type="text" name="name" x-model="form.name" class="w-full bg-gray-900 border-gray-700 rounded-lg text-white focus:ring-blue-500" required>
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="button" @click="showModal = false" class="px-4 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700">{{ __('messages.cancel') }}</button>
                            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-bold">{{ __('messages.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            style="display: none;">
            <div class="glass-dark rounded-xl p-6 w-full max-w-sm shadow-2xl border border-red-500/30 transform transition-all"
                @click.away="showDeleteModal = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-900/30 mb-6 border border-red-500/30 shadow-[0_0_15px_rgba(239,68,68,0.2)]">
                        <svg class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <h3 class="text-xl leading-6 font-bold text-white mb-2">{{ __('messages.delete_category_title') }}</h3>
                    <p class="text-sm text-gray-300 mb-8 px-4">
                        {{ __('messages.delete_category_msg') }}
                    </p>
                    <div class="flex justify-center gap-3">
                        <button @click="showDeleteModal = false" class="px-5 py-2.5 rounded-xl text-gray-300 hover:text-white hover:bg-gray-700/50 transition w-full border border-gray-600 font-medium">
                            {{ __('messages.cancel') }}
                        </button>
                        <form :action="deleteAction" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-pink-600 text-white hover:from-red-500 hover:to-pink-500 font-bold transition w-full shadow-lg shadow-red-500/30 border border-red-500/50">
                                {{ __('messages.delete_confirm') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
