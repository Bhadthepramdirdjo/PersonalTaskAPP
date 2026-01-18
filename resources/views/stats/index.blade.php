<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h2 class="text-2xl font-bold text-white mb-6">Productivity Statistics</h2>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Tasks -->
                <div class="glass-dark rounded-xl p-6 text-center">
                    <p class="text-gray-400 text-sm uppercase tracking-wider">Total Tasks Created</p>
                    <p class="text-4xl font-bold text-white mt-2">{{ $totalTasks }}</p>
                </div>
                <!-- Completed -->
                <div class="glass-dark rounded-xl p-6 text-center">
                    <p class="text-gray-400 text-sm uppercase tracking-wider">Tasks Completed</p>
                    <p class="text-4xl font-bold text-green-400 mt-2">{{ $completedTasks }}</p>
                </div>
                <!-- Completion Rate -->
                <div class="glass-dark rounded-xl p-6 text-center">
                    <p class="text-gray-400 text-sm uppercase tracking-wider">Completion Rate</p>
                    <div class="relative pt-1 mt-2">
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-700">
                            <div style="width:{{ $completionRate }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500"></div>
                        </div>
                        <p class="text-2xl font-bold text-blue-400">{{ $completionRate }}%</p>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Weekly Activity -->
                <div class="glass-dark rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Weekly Activity</h3>
                    <div class="relative h-64">
                         <canvas id="weeklyChart"></canvas>
                    </div>
                </div>

                <!-- Priority Breakdown -->
                <div class="glass-dark rounded-xl p-6">
                    <h3 class="text-lg font-bold text-white mb-4">Tasks by Priority</h3>
                    <div class="relative h-64 flex justify-center">
                        <canvas id="priorityChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tasks by Category -->
            <div class="mt-6 glass-dark rounded-xl p-6">
                 <h3 class="text-lg font-bold text-white mb-4">{{ __('messages.tasks_by_category') }}</h3>
                 <div class="relative h-64 flex justify-center">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Weekly Chart
        const ctxWeekly = document.getElementById('weeklyChart').getContext('2d');
        new Chart(ctxWeekly, {
            type: 'bar',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    label: 'Completed Tasks',
                    data: @json($chartData['data']),
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(255, 255, 255, 0.1)' },
                        ticks: { color: 'rgba(255, 255, 255, 0.7)' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: 'rgba(255, 255, 255, 0.7)' }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Priority Chart
        const ctxPriority = document.getElementById('priorityChart').getContext('2d');
        const priorityData = @json($tasksByPriority);
        
        new Chart(ctxPriority, {
            type: 'doughnut',
            data: {
                labels: Object.keys(priorityData),
                datasets: [{
                    data: Object.values(priorityData),
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.7)', // Low - Green
                        'rgba(245, 158, 11, 0.7)', // Medium - Yellow
                        'rgba(239, 68, 68, 0.7)'   // High - Red
                    ],
                    borderColor: 'transparent',
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { color: 'white' }
                    }
                }
            }
        });

        // Category Chart
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        const categoryData = @json($tasksByCategory);
        
        new Chart(ctxCategory, {
            type: 'doughnut',
            data: {
                labels: Object.keys(categoryData),
                datasets: [{
                    data: Object.values(categoryData),
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',  // Blue
                        'rgba(139, 92, 246, 0.7)',  // Purple
                        'rgba(236, 72, 153, 0.7)',  // Pink
                        'rgba(16, 185, 129, 0.7)',  // Green
                        'rgba(245, 158, 11, 0.7)',  // Yellow
                        'rgba(239, 68, 68, 0.7)'    // Red
                    ],
                    borderColor: 'transparent',
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { color: 'white' }
                    }
                }
            }
        });
    </script>
</x-app-layout>
