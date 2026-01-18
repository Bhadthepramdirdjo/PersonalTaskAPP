<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-100">
        <div class="flex h-screen overflow-hidden" x-data="{ openMobileMenu: false }" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);">
            
            <!-- Mobile Menu Overlay & Sidebar -->
            <div x-show="openMobileMenu" 
                 x-cloak
                 class="fixed inset-0 z-50 flex" 
                 style="display: none;">
                
                <!-- Backdrop -->
                <div @click="openMobileMenu = false"
                     x-show="openMobileMenu"
                     x-transition:enter="transition-opacity ease-linear duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-linear duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-900 bg-opacity-80 backdrop-blur-sm">
                </div>

                <!-- Sliding Sidebar -->
                <div x-show="openMobileMenu"
                     x-transition:enter="transition ease-in-out duration-300 transform"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in-out duration-300 transform"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full"
                     class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-900 border-r border-gray-700">
                    
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button @click="openMobileMenu = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <div class="h-16 flex items-center justify-center border-b border-gray-700 bg-gray-900">
                        <img src="{{ asset('img/Logo_baru.svg') }}" class="w-8 h-8 mr-3" alt="Logo">
                        <h1 class="text-xl font-bold text-white tracking-widest">TASK APP</h1>
                    </div>

                    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            <span class="font-medium">{{ __('messages.dashboard') }}</span>
                        </a>

                        <a href="{{ route('tasks.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('tasks.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            <span class="font-medium">{{ __('messages.tasks') }}</span>
                        </a>

                        <a href="{{ route('categories.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            <span class="font-medium">{{ __('messages.categories') }}</span>
                        </a>
                        
                        <a href="{{ route('stats.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('stats.index') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2 2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                             <span class="font-medium">{{ __('messages.statistics') }}</span>
                        </a>

                        <a href="{{ route('settings.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('settings.edit') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="font-medium">{{ __('messages.settings') }}</span>
                        </a>
                        <a href="{{ route('about') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('about') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="font-medium">{{ __('messages.about') }}</span>
                        </a>
                    </nav>

                    <div class="border-t border-gray-700 p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                @if(Auth::user()->profile_photo)
                                    <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    {{ __('messages.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Force sidebar to shrink to fit close icon -->
                </div>
            </div>
            
            <!-- Sidebar -->
            <aside class="w-64 bg-gray-900 bg-opacity-40 backdrop-filter backdrop-blur-lg border-r border-gray-700 hidden md:flex flex-col">
                <div class="h-20 flex items-center justify-center border-b border-gray-700 border-opacity-50">
                     <img src="{{ asset('img/Logo_baru.svg') }}" class="w-10 h-10 mr-3" alt="Logo">
                     <h1 class="text-2xl font-bold text-white tracking-widest">TASK APP</h1>
                </div>

                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-400 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span class="font-medium">{{ __('messages.dashboard') }}</span>
                    </a>

                    <!-- Tasks -->
                    <a href="{{ route('tasks.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('tasks.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-400 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span class="font-medium">{{ __('messages.tasks') }}</span>
                    </a>

                    <!-- Categories -->
                    <a href="{{ route('categories.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-400 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        <span class="font-medium">{{ __('messages.categories') }}</span>
                    </a>

                    <!-- Statistics -->
                    <a href="{{ route('stats.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('stats.index') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-400 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2 2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <span class="font-medium">{{ __('messages.statistics') }}</span>
                    </a>

                     <!-- Settings -->
                    <a href="{{ route('settings.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('settings.edit') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-400 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="font-medium">{{ __('messages.settings') }}</span>
                    </a>
                    
                    <!-- About -->
                    <a href="{{ route('about') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('about') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-400 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium">{{ __('messages.about') }}</span>
                    </a>
                </nav>

                <div class="p-4 border-t border-gray-700 border-opacity-50">
                    <div class="flex items-center gap-3">
                         <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold overflow-hidden">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="h-full w-full object-cover">
                            @else
                                {{ substr(Auth::user()->name, 0, 1) }}
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden relative">
                <!-- Mobile Header -->
                <header class="md:hidden h-16 bg-gray-900 border-b border-gray-700 flex items-center justify-between px-4">
                     <span class="text-white font-bold text-lg">PersonalTask</span>
                     <button @click="openMobileMenu = !openMobileMenu" class="text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                     </button>
                </header>

                <!-- Flash Notifications -->
                <div class="fixed top-5 right-5 z-50 space-y-3" 
                     x-data="{ 
                        notifications: [],
                        add(msg, type = 'success') {
                            const id = Date.now();
                            this.notifications.push({ id, msg, type });
                            setTimeout(() => {
                                this.remove(id);
                            }, 2000); // 2 seconds
                        },
                        remove(id) {
                            const index = this.notifications.findIndex(n => n.id === id);
                            if (index > -1) {
                                this.notifications.splice(index, 1);
                            }
                        }
                     }"
                     @if(session('success'))
                        x-init="add('{{ session('success') }}', 'success')"
                     @endif
                     @if(session('error'))
                        x-init="add('{{ session('error') }}', 'error')"
                     @endif
                     @if(session('status') === 'profile-updated')
                        x-init="add('Profile Updated Successfully', 'success')"
                     @elseif(session('status') === 'password-updated')
                        x-init="add('Password Updated Successfully', 'success')"
                     @elseif(session('status'))
                        x-init="add('{{ session('status') }}', 'info')"
                     @endif
                >
                    <template x-for="note in notifications" :key="note.id">
                        <div x-show="true"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-8"
                             x-transition:enter-end="opacity-100 transform translate-x-0"
                             x-transition:leave="transition ease-in duration-500"
                             x-transition:leave-start="opacity-100 transform translate-x-0"
                             x-transition:leave-end="opacity-0 transform translate-x-8"
                             :class="{
                                'border-green-500 text-green-200': note.type === 'success',
                                'border-red-500 text-red-200': note.type === 'error',
                                'border-blue-500 text-blue-200': note.type === 'info'
                             }"
                             class="glass-dark border border-opacity-50 px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 min-w-[300px]"
                        >
                            <!-- Icons -->
                            <template x-if="note.type === 'success'">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </template>
                            <template x-if="note.type === 'error'">
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </template>
                             <template x-if="note.type === 'info'">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </template>

                            <p class="font-medium" x-text="note.msg"></p>
                        </div>
                    </template>
                </div>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-transparent">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>