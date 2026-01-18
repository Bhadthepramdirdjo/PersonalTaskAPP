<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Hero / Creator Profile Section -->
            <div class="glass-dark rounded-xl p-8 mb-6 text-white text-center shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
                
                <div class="mb-6 flex justify-center flex-col items-center">
                    <span class="text-sm font-light text-gray-400 mb-4 tracking-wider uppercase">{{ __('messages.program_created_by') }}</span>
                    <img src="{{ asset('img/bhadriko.png') }}" alt="Bhadriko Theo Pramudya Djojosoedirdjo" class="h-32 w-32 rounded-full border-4 border-gray-600 shadow-lg object-cover">
                </div>

                <h1 class="text-3xl font-extrabold mb-2 bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-400">
                    Bhadriko Theo Pramudya Djojosoedirdjo
                </h1>
                <p class="text-lg text-gray-300 font-medium mb-4">{{ __('messages.creator_role') }}</p>
                
                <div class="flex flex-wrap justify-center gap-4 text-sm text-gray-400 mb-6">
                    <span class="flex items-center gap-2 bg-gray-800 px-3 py-1 rounded-full border border-gray-700">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        {{ __('messages.university') }}
                    </span>
                    <span class="flex items-center gap-2 bg-gray-800 px-3 py-1 rounded-full border border-gray-700">
                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        {{ __('messages.organization_role') }} - {{ __('messages.organization') }}
                    </span>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-6 text-sm border-t border-gray-700 pt-6 mt-6">
                    <div>
                        <span class="block text-gray-500 text-xs uppercase tracking-wider">{{ __('messages.designed_in') }}</span>
                        <span class="font-bold text-white">August 2025</span>
                    </div>
                    <div>
                        <span class="block text-gray-500 text-xs uppercase tracking-wider">{{ __('messages.published_in') }}</span>
                        <span class="font-bold text-white">2026 (Coming Soon)</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Our Story -->
                <div class="glass-dark rounded-xl p-6 h-full">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        {{ __('messages.our_story') }}
                    </h2>
                    <p class="text-gray-300 leading-relaxed">
                        {{ __('messages.story_content') }}
                    </p>
                </div>

                <!-- User Guide -->
                <div class="glass-dark rounded-xl p-6 h-full">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ __('messages.user_guide') }}
                    </h2>
                    <ul class="space-y-4">
                        <li class="flex gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded bg-gray-800 flex items-center justify-center text-blue-500 font-bold border border-gray-700">1</span>
                            <p class="text-gray-300 text-sm">{{ __('messages.guide_dashboard') }}</p>
                        </li>
                        <li class="flex gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded bg-gray-800 flex items-center justify-center text-green-500 font-bold border border-gray-700">2</span>
                            <p class="text-gray-300 text-sm">{{ __('messages.guide_tasks') }}</p>
                        </li>
                         <li class="flex gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded bg-gray-800 flex items-center justify-center text-purple-500 font-bold border border-gray-700">3</span>
                            <p class="text-gray-300 text-sm">{{ __('messages.guide_categories') }}</p>
                        </li>
                         <li class="flex gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded bg-gray-800 flex items-center justify-center text-orange-500 font-bold border border-gray-700">4</span>
                            <p class="text-gray-300 text-sm">{{ __('messages.guide_settings') }}</p>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Tech Stack (Optional Visual) -->
            <div class="text-center text-gray-500 text-xs mt-8">
                <p>&copy; {{ __('messages.copyright') }} bhadriko 2026</p>
            </div>
        </div>
    </div>
</x-app-layout>
