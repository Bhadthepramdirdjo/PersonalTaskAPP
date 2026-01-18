<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="text-2xl font-bold text-white mb-6">Settings</h2>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-500 bg-opacity-20 border border-green-500 text-green-300 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Profile Information (Reuse Breeze Component logic wrapped in Glass) -->
                <div class="glass-dark rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Profile Information</h3>
                    
                    <!-- Photo Upload -->
                    <div class="mb-6 flex items-center gap-4">
                        <div class="h-16 w-16 rounded-full bg-blue-500 flex items-center justify-center text-white text-xl font-bold overflow-hidden border-2 border-gray-600">
                             @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                            @else
                                {{ substr($user->name, 0, 1) }}
                            @endif
                        </div>
                        <form action="{{ route('settings.update-photo') }}" method="POST" enctype="multipart/form-data" class="flex-1">
                            @csrf
                            <label class="block text-sm font-medium text-gray-400 mb-1">Update Photo</label>
                            <div class="flex gap-2">
                                <input type="file" name="photo" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer bg-gray-900 rounded-lg">
                                <button type="submit" class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition font-bold text-sm">Upload</button>
                            </div>
                        </form>
                    </div>

                    <div class="text-gray-300">
                        <p class="mb-4">Update your account's profile information and email address.</p>
                        
                        <div class="mb-4">
                            <label class="block text-gray-400 text-sm mb-1">Name</label>
                            <input type="text" value="{{ $user->name }}" class="w-full bg-gray-900 border-gray-700 rounded-lg text-gray-500 cursor-not-allowed" disabled>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-400 text-sm mb-1">Email</label>
                            <input type="email" value="{{ $user->email }}" class="w-full bg-gray-900 border-gray-700 rounded-lg text-gray-500 cursor-not-allowed" disabled>
                        </div>

                         <div class="mt-4">
                            <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-bold text-sm">
                                Go to Full Profile Settings
                            </a>
                        </div>
                    </div>
                </div>

                <!-- App Preferences -->
                <div class="glass-dark rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">{{ __('messages.application_preferences') }}</h3>
                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf
                        @method('PATCH')

                        <!-- Language Selection -->
                        <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-2">{{ __('messages.language') }}</label>
                            <select name="language" class="w-full bg-gray-900 border-gray-700 rounded-lg text-white focus:ring-blue-500">
                                <option value="en" {{ ($settings->language ?? 'en') === 'en' ? 'selected' : '' }}>English</option>
                                <option value="id" {{ ($settings->language ?? 'en') === 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                            </select>
                        </div>

                        <!-- Default Reminder -->
                        <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-2">{{ __('messages.default_reminder') }}</label>
                            <select name="default_reminder_type" class="w-full bg-gray-900 border-gray-700 rounded-lg text-white focus:ring-blue-500">
                                <option value="none" {{ $settings->default_reminder_type === 'none' ? 'selected' : '' }}>{{ __('messages.no_reminder_default') }}</option>
                                <option value="2_jam" {{ $settings->default_reminder_type === '2_jam' ? 'selected' : '' }}>{{ __('messages.hours_before') }}</option>
                                <option value="1_hari" {{ $settings->default_reminder_type === '1_hari' ? 'selected' : '' }}>{{ __('messages.day_before') }}</option>
                                <option value="2_hari" {{ $settings->default_reminder_type === '2_hari' ? 'selected' : '' }}>{{ __('messages.2_days_before') }}</option>
                                <option value="3_hari" {{ $settings->default_reminder_type === '3_hari' ? 'selected' : '' }}>{{ __('messages.3_days_before') }}</option>
                            </select>
                        </div>

                        <!-- Email Notifications -->
                        <div class="mb-6">
                            <label class="flex items-center space-x-3">
                                <input type="hidden" name="email_notification" value="0">
                                <input type="checkbox" name="email_notification" value="1" {{ $settings->email_notification ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-blue-600 bg-gray-900 border-gray-700 rounded focus:ring-blue-500">
                                <span class="text-gray-300">{{ __('messages.enable_email_notif') }}</span>
                            </label>
                        </div>

                        <!-- Email Template Customization -->
                         <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-2">{{ __('messages.custom_email_template') }}</label>
                            <textarea name="email_template" rows="4" class="w-full bg-gray-900 border-gray-700 rounded-lg text-white focus:ring-blue-500 text-sm font-mono" placeholder="{{ __('messages.email_template_placeholder') }}">{{ $settings->email_template }}</textarea>
                             <div class="mt-3 bg-gray-800 rounded-lg p-3 text-xs border border-gray-700">
                                <p class="font-semibold text-gray-300 mb-2">{{ __('messages.placeholder_guide') }}</p>
                                <ul class="space-y-1 text-gray-400">
                                    <li class="flex items-center gap-2"><code class="bg-gray-900 text-blue-400 px-1.5 py-0.5 rounded border border-gray-600 font-mono">{name}</code> <span>{{ __('messages.placeholder_name') }}</span></li>
                                    <li class="flex items-center gap-2"><code class="bg-gray-900 text-blue-400 px-1.5 py-0.5 rounded border border-gray-600 font-mono">{title}</code> <span>{{ __('messages.placeholder_title') }}</span></li>
                                    <li class="flex items-center gap-2"><code class="bg-gray-900 text-blue-400 px-1.5 py-0.5 rounded border border-gray-600 font-mono">{deadline}</code> <span>{{ __('messages.placeholder_deadline') }}</span></li>
                                    <li class="flex items-center gap-2"><code class="bg-gray-900 text-blue-400 px-1.5 py-0.5 rounded border border-gray-600 font-mono">{description}</code> <span>{{ __('messages.placeholder_description') }}</span></li>
                                </ul>
                                <p class="mt-3 italic text-gray-500 opacity-75">{{ __('messages.placeholder_guide_note') }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-gray-700 pt-6">
                            <button type="submit" form="test-email-form" class="w-full sm:w-auto px-4 py-2 rounded-lg bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-white font-bold transition flex items-center justify-center gap-2 border border-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>{{ __('messages.send_test_email') }}</span>
                            </button>
                            
                            <button type="submit" class="w-full sm:w-auto px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 font-bold transition">
                                {{ __('messages.save_preferences') }}
                            </button>
                        </div>
                    </form>
                    
                    <!-- Separate Form for Test Email Button Logic to work with the main form structure -->
                    <form id="test-email-form" action="{{ route('settings.test-email') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
