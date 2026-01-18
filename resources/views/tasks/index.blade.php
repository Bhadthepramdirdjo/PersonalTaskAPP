<x-app-layout>
    <div class="py-12" x-data="{ 
        showModal: false, 
        isEdit: false, 
        taskId: null,
        showDeleteModal: false,
        deleteAction: null,
        form: { title: '', deadline: '', priority_id: 1, category_id: '', description: '' },
        confirmDelete(url) {
            this.deleteAction = url;
            this.showDeleteModal = true;
        },
        openCreate() {
            this.isEdit = false;
            this.form = { title: '', deadline: '', priority_id: 1, category_id: '', description: '', reminder_type: 'none' };
            this.showModal = true;
        },
        openEdit(task) {
            this.isEdit = true;
            this.taskId = task.id;
            this.form = { 
                title: task.title, 
                deadline: task.deadline.slice(0, 16), // Format for datetime-local
                priority_id: task.priority_id, 
                category_id: task.category_id, 
                description: task.description,
                reminder_type: task.reminders && task.reminders.find(r => r.is_active) ? task.reminders.find(r => r.is_active).reminder_type : 'none'
            };
            this.showModal = true;
        }
     }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-dark rounded-xl p-6 mb-6 flex justify-between items-center text-white">
                <h2 class="text-2xl font-bold">{{ __('messages.my_tasks') }}</h2>
                <button @click="openCreate()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    + {{ __('messages.new_task') }}
                </button>
            </div>

            <!-- Filters -->
            <div class="glass-dark rounded-xl p-4 mb-6 text-white flex gap-4 overflow-x-auto">
                <form method="GET" action="{{ route('tasks.index') }}" class="flex gap-4 items-center w-full">
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.search_placeholder') }}" class="bg-gray-800 border-gray-700 rounded-lg text-white text-sm pl-8 pr-4 py-2 focus:ring-blue-500 w-48">
                        <svg class="w-4 h-4 text-gray-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>

                    <select name="status" class="bg-gray-800 border-gray-700 rounded text-white text-sm" onchange="this.form.submit()">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>{{ __('messages.all_status') }}</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('messages.pending') }}</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>{{ __('messages.completed') }}</option>
                    </select>

                    <select name="priority_id" class="bg-gray-800 border-gray-700 rounded text-white text-sm" onchange="this.form.submit()">
                        <option value="">{{ __('messages.all_priorities') }}</option>
                        @foreach($priorities as $priority)
                            <option value="{{ $priority->id }}" {{ request('priority_id') == $priority->id ? 'selected' : '' }}>{{ $priority->name }}</option>
                        @endforeach
                    </select>

                    <select name="category_id" class="bg-gray-800 border-gray-700 rounded text-white text-sm" onchange="this.form.submit()">
                        <option value="">{{ __('messages.all_categories') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <!-- Search Button (Hidden but enables Enter key) -->
                    <button type="submit" class="hidden"></button>

                     <!-- Clear Filters -->
                     <a href="{{ route('tasks.index') }}" class="bg-gray-700 hover:bg-gray-600 text-gray-200 text-sm font-medium px-4 py-2 rounded-lg transition shadow-sm whitespace-nowrap flex items-center gap-2 border border-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        {{ __('messages.clear_filters') }}
                     </a>
                </form>
            </div>

            <!-- Task List -->
            <div class="glass-dark rounded-xl p-6">
                <!-- Pending Tasks -->
                @if(isset($pendingTasks) && $pendingTasks->count() > 0)
                    <h3 class="text-lg font-bold text-white mb-4">{{ __('messages.pending_tasks') }} ({{ $pendingTasks->count() }})</h3>
                    <div class="space-y-4 mb-8">
                        @foreach($pendingTasks as $task)
                        @php
                            $isOverdue = $task->deadline->isPast();
                            $isDueSoon = !$isOverdue && $task->deadline->lte(now()->addHours(48));
                        @endphp
                        <div class="bg-gray-800 bg-opacity-60 rounded-lg p-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 transition hover:bg-opacity-80 border-l-4 {{ $task->priority->id == 3 ? 'border-red-500' : ($task->priority->id == 2 ? 'border-yellow-500' : 'border-green-500') }}">
                            <div class="flex items-start gap-4 flex-1">
                                <form method="POST" action="{{ route('tasks.complete', $task) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="mt-1 w-6 h-6 rounded border-2 border-gray-500 hover:border-blue-500 flex items-center justify-center transition">
                                    </button>
                                </form>
                                <div>
                                    <h4 class="text-lg font-bold text-white">{{ $task->title }}</h4>
                                    <p class="text-gray-400 text-sm mb-2">{{ Str::limit($task->description, 100) }}</p>
                                    <div class="flex flex-wrap gap-2 text-xs">
                                        {{-- Date --}}
                                        <span class="flex items-center gap-1 text-gray-300 bg-gray-700 px-2 py-1 rounded">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $task->deadline->format('M d, H:i') }}
                                        </span>

                                        <span class="px-2 py-1 rounded {{ $task->priority->id == 3 ? 'bg-red-900 text-red-200' : ($task->priority->id == 2 ? 'bg-yellow-900 text-yellow-200' : 'bg-green-900 text-green-200') }}">
                                            {{ $task->priority->name }}
                                        </span>
                                        @if($task->category)
                                            <span class="px-2 py-1 rounded bg-blue-900 text-blue-200">
                                                {{ $task->category->name }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                {{-- Deadline Indicators (Moved here) --}}
                                @if($isOverdue)
                                    <span class="flex items-center gap-1 bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-[0_0_10px_rgba(220,38,38,0.7)] animate-pulse border border-red-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ __('messages.overdue') }}
                                    </span>
                                @elseif($isDueSoon)
                                    <span class="flex items-center gap-1 bg-yellow-400 text-gray-900 px-3 py-1.5 rounded-lg text-xs font-extrabold shadow-[0_0_10px_rgba(250,204,21,0.6)] border border-yellow-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        {{ __('messages.due_soon') }}
                                    </span>
                                @endif

                                <div class="flex gap-2">
                                    <button @click='openEdit(@json($task))' class="text-gray-400 hover:text-blue-400 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button @click="confirmDelete('{{ route('tasks.destroy', $task) }}')" class="text-gray-400 hover:text-red-400 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
                
                <!-- Completed Tasks -->
                @if(isset($completedTasks) && $completedTasks->count() > 0)
                    @if(isset($pendingTasks) && $pendingTasks->count() > 0)
                        <hr class="border-gray-700 mb-6">
                    @endif
                    <h3 class="text-lg font-bold text-gray-400 mb-4 flex items-center gap-2">
                        {{ __('messages.completed_tasks') }} ({{ $completedTasks->count() }})
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </h3>
                    <div class="space-y-4 opacity-75">
                        @foreach($completedTasks as $task)
                        <div class="bg-gray-800 bg-opacity-40 rounded-lg p-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 transition hover:bg-opacity-60 border-l-4 border-gray-600">
                            <div class="flex items-start gap-4 flex-1">
                                <form method="POST" action="{{ route('tasks.complete', $task) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="mt-1 w-6 h-6 rounded bg-green-500 border-2 border-green-500 flex items-center justify-center transition hover:bg-green-600">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>
                                <div class="line-through text-gray-500">
                                    <h4 class="text-lg font-bold">{{ $task->title }}</h4>
                                    <p class="text-sm mb-2">{{ Str::limit($task->description, 100) }}</p>
                                    <div class="flex flex-wrap gap-2 text-xs">
                                        <span class="flex items-center gap-1 bg-gray-800 px-2 py-1 rounded">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $task->deadline->format('M d, H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                             <div class="flex gap-2">
                                <button @click='openEdit(@json($task))' class="text-gray-600 hover:text-blue-400 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button @click="confirmDelete('{{ route('tasks.destroy', $task) }}')" class="text-gray-600 hover:text-red-400 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
                
                @if((!isset($pendingTasks) || $pendingTasks->isEmpty()) && (!isset($completedTasks) || $completedTasks->isEmpty()))
                     <div class="text-center py-10 text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <p class="text-xl font-medium">{{ __('messages.no_tasks_found') }}</p>
                        <p class="text-sm mt-2">{{ __('messages.create_task_start') }}</p>
                    </div>
                @endif
            </div>

            <!-- Modal -->
            <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 backdrop-blur-sm" style="display: none;">
                <div class="bg-gray-800 rounded-xl p-6 w-full max-w-lg shadow-2xl border border-gray-700" @click.away="showModal = false">
                    <h3 class="text-xl font-bold text-white mb-4" x-text="isEdit ? '{{ __('messages.edit_task') }}' : '{{ __('messages.create_task') }}'"></h3>
                    <form :action="isEdit ? '/tasks/' + taskId : '/tasks'" method="POST">
                        @csrf
                        <template x-if="isEdit">
                             <input type="hidden" name="_method" value="PUT">
                        </template>

                        <!-- Title -->
                        <div class="mb-4">
                            <label class="block text-gray-400 text-sm mb-1">{{ __('messages.title') }}</label>
                            <input type="text" name="title" x-model="form.title" class="w-full bg-gray-900 border-gray-700 rounded-lg text-white focus:ring-blue-500" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="block text-gray-400 text-sm mb-1">{{ __('messages.description') }}</label>
                            <textarea name="description" x-model="form.description" class="w-full bg-gray-900 border-gray-700 rounded-lg text-white focus:ring-blue-500"></textarea>
                        </div>

                         <div class="grid grid-cols-2 gap-4 mb-4">
                            <!-- Deadline -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">{{ __('messages.deadline') }}</label>
                                <input type="datetime-local" name="deadline" x-model="form.deadline" class="w-full bg-gray-900 border-gray-700 rounded-lg text-white focus:ring-blue-500" required>
                            </div>
                            <!-- Priority -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-1">{{ __('messages.priority') }}</label>
                                <select name="priority_id" x-model="form.priority_id" class="w-full bg-gray-900 border-gray-700 rounded-lg text-white focus:ring-blue-500">
                                    @foreach($priorities as $priority)
                                        <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Category -->
                         <div class="mb-4">
                            <label class="block text-gray-400 text-sm mb-1">{{ __('messages.category') }} (Optional)</label>
                            <select name="category_id" x-model="form.category_id" class="w-full bg-gray-900 border-gray-700 rounded-lg text-white focus:ring-blue-500">
                                <option value="">None</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                         <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-1">{{ __('messages.email_reminder') }}</label>
                            <select name="reminder_type" x-model="form.reminder_type" class="w-full bg-gray-900 border-gray-700 rounded-lg text-white focus:ring-blue-500">
                                <option value="none">{{ __('messages.no_reminder') }}</option>
                                <option value="2_jam">{{ __('messages.hours_before') }}</option>
                                <option value="1_hari">{{ __('messages.day_before') }}</option>
                                <option value="2_hari">{{ __('messages.2_days_before') }}</option>
                                <option value="3_hari">{{ __('messages.3_days_before') }}</option>
                            </select>
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="button" @click="showModal = false" class="px-4 py-2 rounded-lg text-gray-300 hover:text-white hover:bg-gray-700">{{ __('messages.cancel') }}</button>
                            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-bold">{{ __('messages.save_task') }}</button>
                        </div>
                    </form>
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
                        <h3 class="text-xl leading-6 font-bold text-white mb-2">{{ __('messages.delete_task_title') }}</h3>
                        <p class="text-sm text-gray-300 mb-8 px-4">
                            {{ __('messages.delete_task_msg') }}
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
    </div>
</x-app-layout>
