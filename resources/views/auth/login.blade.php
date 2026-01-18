<x-guest-layout>
    <div x-data="{ tab: 'login' }">
        <!-- Tabs -->
        <div class="flex justify-center mb-6 border-b border-gray-700">
            <button @click="tab = 'login'" :class="{ 'border-blue-500 text-white': tab === 'login', 'border-transparent text-gray-400 hover:text-gray-200': tab !== 'login' }" class="pb-2 px-4 text-lg font-medium border-b-2 transition duration-300">
                Log In
            </button>
            <button @click="tab = 'register'" :class="{ 'border-blue-500 text-white': tab === 'register', 'border-transparent text-gray-400 hover:text-gray-200': tab !== 'register' }" class="pb-2 px-4 text-lg font-medium border-b-2 transition duration-300 ml-4">
                Register
            </button>
        </div>

        <!-- Login Form -->
        <div x-show="tab === 'login'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label class="block font-medium text-sm text-gray-300" for="email">Email</label>
                    <input class="block mt-1 w-full bg-gray-800 border-gray-700 rounded-md shadow-sm text-white focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4" x-data="{ show: false }">
                     <label class="block font-medium text-sm text-gray-300" for="password">Password</label>
                     <div class="relative">
                        <input class="block mt-1 w-full bg-gray-800 border-gray-700 rounded-md shadow-sm text-white focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 pr-10" id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" />
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-white transition">
                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-gray-800 border-gray-700 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                        <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-400 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif

                    <button class="ms-3 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Register Form -->
        <div x-show="tab === 'register'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
             <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                     <label class="block font-medium text-sm text-gray-300" for="name">Name</label>
                    <input class="block mt-1 w-full bg-gray-800 border-gray-700 rounded-md shadow-sm text-white focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                     <label class="block font-medium text-sm text-gray-300" for="email">Email</label>
                    <input class="block mt-1 w-full bg-gray-800 border-gray-700 rounded-md shadow-sm text-white focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4" x-data="{ show: false }">
                     <label class="block font-medium text-sm text-gray-300" for="password">Password</label>
                     <div class="relative">
                        <input class="block mt-1 w-full bg-gray-800 border-gray-700 rounded-md shadow-sm text-white focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 pr-10" id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password" />
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-white transition">
                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4" x-data="{ show: false }">
                    <label class="block font-medium text-sm text-gray-300" for="password_confirmation">Confirm Password</label>
                    <div class="relative">
                        <input class="block mt-1 w-full bg-gray-800 border-gray-700 rounded-md shadow-sm text-white focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 pr-10" id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" />
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-white transition">
                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button class="ms-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
