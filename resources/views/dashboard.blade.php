<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Section -->
            <div class="glass-dark rounded-xl p-6 text-white border border-gray-700 shadow-2xl relative overflow-hidden" x-data="{
                            quotes: [
                                'Hari ini kamu bangun dengan semangat atau dengan beban, dua duanya ga apa apa',
                                'Apa kabar hari ini, masih kuat pura pura atau akhirnya jujur capek',
                                'Kalo hari ini berat, inget kamu ga harus jadi hebat, cukup bertahan',
                                'Kamu masih di sini, itu aja sebenernya udah pencapaian',
                                'Hari ini mau kejar mimpi, atau sekadar ga nyerah',
                                'Ada hal kecil yang bisa kamu beresin hari ini, satu aja cukup',
                                'Kamu ga terlambat, kamu cuma lagi di tempo hidupmu sendiri',
                                'Hari ini kamu mau jadi versi siapa dari dirimu',
                                'Kalo kamu ngerasa sendiri, pelan pelan, kamu ga beneran sendirian',
                                'Semoga hari ini kamu lebih ramah sama diri sendiri',
                                'Kamu gapapa kalo capek, yang penting jangan berhenti percaya',
                                'Hari ini kamu mau buktiin apa ke dirimu sendiri',
                                'Dunia boleh ribut, tapi langkahmu tetep punya arti',
                                'Kamu masih berdiri, meski sempat pengen rebah lama',
                                'Ga semua hari harus produktif, ada hari yang cukup dilalui',
                                'Apa satu hal yang bikin kamu bertahan sejauh ini',
                                'Kamu ga harus ngerti semuanya sekarang',
                                'Hari ini kamu mau pelan atau ngebut, dua duanya sah',
                                'Kamu masih nyoba, dan itu berani',
                                'Kalo hari ini sunyi, dengerin dirimu sendiri',
                                'Kamu ga gagal, kamu lagi belajar dengan cara yang ga enak',
                                'Semoga hari ini kamu nemu alasan kecil buat senyum',
                                'Kamu lebih kuat dari yang kamu kira, meski kamu sering lupa',
                                'Hari ini kamu milih lanjut, dan itu keputusan besar',
                                'Apa kabar hatimu, masih aman atau lagi bocor dikit',
                                'Kamu ga sendirian di rasa lelah ini',
                                'Hidup ga minta kamu sempurna, cuma jujur sama diri sendiri',
                                'Hari ini kamu mau mulai lagi, atau nerusin yang kemarin',
                                'Kamu berhak istirahat tanpa ngerasa bersalah',
                                'Semoga langkah kecilmu hari ini cukup buat nyalain harapan',
                                'Kamu masih di jalan, meski pelan dan muter',
                                'Kalo hari ini berat, kamu boleh ngeluh, tapi jangan nyerah',
                                'Dunia ga selalu adil, tapi kamu tetep berharga',
                                'Hari ini kamu mau nyelesain apa, sekecil apapun',
                                'Kamu ga harus kuat setiap waktu',
                                'Semoga hari ini kamu inget alasan kenapa kamu bertahan',
                                'Kamu bukan tertinggal, kamu cuma lagi napas dulu',
                                'Apa satu hal yang pengen kamu jaga hari ini, mimpi atau hati',
                                'Kamu masih layak dapet hal baik',
                                'Hari ini kamu milik dirimu sendiri',
                                'Kalo capek, jangan hilang, istirahat aja',
                                'Kamu ga berantakan, kamu lagi nyusun ulang',
                                'Hidup bukan lomba, jadi ga perlu bandingin langkah',
                                'Hari ini kamu mau lebih jujur ke siapa, ke dunia atau ke diri sendiri',
                                'Kamu masih punya waktu',
                                'Semoga hari ini kamu ga nyerah sama dirimu',
                                'Kamu ga rusak, kamu cuma lelah',
                                'Hari ini kamu masih milih hidup, dan itu berani',
                                'Pelan pelan aja, asal ga balik arah',
                                'Kamu ga sendirian, bahkan kalo rasanya sepi',
                                'Hari ini kamu dateng dengan kepala penuh apa, dan hati yang masih utuh atau lagi bocor dikit?',
                                'Apa satu hal kecil yang pengen kamu beresin hari ini, meski dunia lagi ribut?',
                                'Kamu lagi jalan ke tujuan yang mana sekarang, atau masih berhenti buat narik napas?',
                                'Hari ini mau jadi hari yang produktif, atau cukup bertahan juga udah hebat?',
                                'Ada rencana yang mau kamu kejar, atau perasaan yang perlu kamu jaga?',
                                'Selamat dateng, semoga hari ini kamu ga lupa sama alasan kamu mulai.',
                                'Langkahmu hari ini mau pelan atau cepat, yang penting tetap maju.',
                                'Apa kabar dirimu hari ini, masih kuat atau butuh istirahat sebentar?',
                                'Semoga apa yang kamu lakuin hari ini sedikit lebih dekat ke hidup yang kamu mau.',
                                'Kamu ga sendirian di sini, ayo jalanin hari ini dengan versi terbaikmu yang kamu sanggupin.',
                                'PESAN SPECIAL BUAT KAMU hai {{ Auth::user()->name }}, aku tau kamu lagi capek. tugas numpuk, pikiran juga berat. gapapa kok ngerasa capek, gapapa juga berhenti sebentar buat istirahat',
                                'PESAN SPECIAL BUAT KAMU hai {{ Auth::user()->name }}, aku tau hari ini ga ringan. tugas datang barengan sama beban di kepala. kalo capek, gapapa, kamu ga harus kuat terus, istirahat sebentar juga bagian dari jalan',
                                'PESAN SPECIAL BUAT KAMU hai {{ Auth::user()->name }}, aku selalu berharap kamu baik baik aja. seberat dan secapek apa pun yang lagi kamu hadapi sekarang, kamu udah sangat hebat karena bisa sampai sejauh ini. dan jujur, aku bangga sama kamu. lanjut pelan pelan ya.',
                                'PESAN SPECIAL BUAT KAMU hai {{ Auth::user()->name }}, semoga hari ini kamu masih baik baik aja. apa pun yang lagi kamu pikul sekarang, fakta kalo kamu masih di sini itu udah luar biasa. aku bangga sama kamu, beneran.',
                                'PESAN SPECIAL BUAT KAMU hai {{ Auth::user()->name }}, sejauh ini kamu udah hebat. pelan pelan aja, aku bangga sama kamu.. Semangatt :)'
                            ],
                            currentQuote: ''
                        }" x-init="currentQuote = quotes[Math.floor(Math.random() * quotes.length)]">
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-blue-600 opacity-10 blur-3xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start gap-6">
                    <div class="flex-1">
                        <h2 class="text-4xl font-extrabold tracking-tight mb-3 text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white">
                            {{ __('messages.welcome_back') }}, {{ Auth::user()->name }}
                        </h2>

                    </div>
                    <div class="text-right hidden md:block" x-data="{
                        date: new Date(),
                        formattedDate: '',
                        updateTime() {
                            const now = new Date();
                            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
                            const locale = '{{ str_replace('_', '-', app()->getLocale()) }}' === 'id' ? 'id-ID' : 'en-US';
                            this.formattedDate = now.toLocaleDateString(locale, options).replace('.', ':');
                        }
                    }" x-init="updateTime(); setInterval(() => updateTime(), 1000)">
                         <div class="inline-block px-4 py-2 rounded-lg bg-gray-800 bg-opacity-50 border border-gray-700">
                            <p class="text-xl font-mono font-bold text-blue-300" x-text="formattedDate"></p>
                        </div>
                    </div>
                </div>

                <div class="relative z-10 block mt-6">
                        <!-- Normal Quote Layout (Full Width Below) -->
                        <template x-if="!currentQuote.includes('PESAN SPECIAL BUAT KAMU')">
                            <p class="text-xl text-gray-300 font-medium leading-relaxed italic" x-text="currentQuote"></p>
                        </template>

                        <!-- Special Quote Layout (Full Width Below) -->
                        <template x-if="currentQuote.includes('PESAN SPECIAL BUAT KAMU')">
                            <div class="bg-gradient-to-br from-indigo-900/40 via-purple-900/40 to-indigo-900/40 p-6 rounded-2xl border border-indigo-500/30 shadow-[0_0_20px_rgba(99,102,241,0.15)] backdrop-blur-sm relative overflow-hidden group w-full">
                                <!-- Glow Effect -->
                                <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-500/20 rounded-full blur-3xl group-hover:bg-indigo-500/30 transition-all duration-500"></div>
                                
                                <!-- Header Badge -->
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold tracking-widest uppercase bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 shadow-sm">
                                        <svg class="w-3 h-3 mr-1 text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        Pesan Special Buat Kamu
                                    </span>
                                </div>
                                
                                <!-- Main Content -->
                                <p class="text-indigo-100 font-semibold text-lg italic leading-relaxed relative z-10" x-text="currentQuote.replace('PESAN SPECIAL BUAT KAMU ', '')"></p>
                            </div>
                        </template>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Completed Tasks -->
                <div class="glass-dark rounded-xl p-6 flex items-center space-x-4">
                    <div class="p-3 bg-blue-600 rounded-full">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-white">{{ $stats['completed'] }}</div>
                        <div class="text-sm text-gray-300">{{ __('messages.completed_tasks') }}</div>
                    </div>
                </div>

                <!-- Pending Tasks -->
                <div class="glass-dark rounded-xl p-6 flex items-center space-x-4">
                    <div class="p-3 bg-yellow-500 rounded-full">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-white">{{ $stats['pending'] }}</div>
                        <div class="text-sm text-gray-300">{{ __('messages.pending_tasks') }}</div>
                    </div>
                </div>

                <!-- Overdue Tasks -->
                <div class="glass-dark rounded-xl p-6 flex items-center space-x-4">
                    <div class="p-3 bg-red-500 rounded-full">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-white">{{ $stats['overdue'] }}</div>
                        <div class="text-sm text-gray-300">{{ __('messages.overdue_tasks') }}</div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Today's Tasks -->
                <div class="glass-dark rounded-xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">{{ __('messages.todays_tasks') }}</h3>
                    @if($todayTasks->count() > 0)
                        <ul class="space-y-3">
                            @foreach($todayTasks as $task)
                                <li class="bg-gray-800 bg-opacity-50 rounded-lg p-3 flex justify-between items-center">
                                    <div>
                                        <p class="text-white font-semibold">{{ $task->title }}</p>
                                        <div class="text-xs text-gray-400">
                                            <span class="{{ $task->priority->name == 'Tinggi' ? 'text-red-400' : 'text-green-400' }}">{{ $task->priority->name }}</span>
                                            @if($task->category) | {{ $task->category->name }} @endif
                                        </div>
                                    </div>
                                    <div class="text-gray-300 text-sm">
                                        {{ $task->deadline->format('H:i') }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400">{{ __('messages.no_tasks_today') }}</p>
                    @endif
                </div>

                <!-- Upcoming Tasks -->
                <div class="glass-dark rounded-xl p-6">
                    <h3 class="text-xl font-bold text-white mb-4">{{ __('messages.upcoming_tasks') }}</h3>
                     @if($upcomingTasks->count() > 0)
                        <ul class="space-y-3">
                            @foreach($upcomingTasks as $task)
                                <li class="bg-gray-800 bg-opacity-50 rounded-lg p-3 flex justify-between items-center">
                                    <div>
                                        <p class="text-white font-semibold">{{ $task->title }}</p>
                                        <div class="text-xs text-gray-400">
                                            {{ $task->deadline->format('M d, H:i') }}
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded bg-blue-900 text-blue-200">
                                        {{ $task->priority->name }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400">{{ __('messages.no_upcoming_tasks') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
