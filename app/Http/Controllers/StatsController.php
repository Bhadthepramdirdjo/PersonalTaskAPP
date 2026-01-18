<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Completion Rate
        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('is_completed', true)->count();
        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // 2. Tasks Completed Last 7 Days (for Chart)
        $completedLast7Days = $user->tasks()
            ->where('is_completed', true)
            ->where('completed_at', '>=', now()->subDays(6)->startOfDay())
            ->select(DB::raw('DATE(completed_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartData['labels'][] = now()->subDays($i)->format('D');
            $chartData['data'][] = $completedLast7Days[$date] ?? 0;
        }

        // 3. Tasks by Priority
        $tasksByPriority = $user->tasks()
            ->join('priorities', 'tasks.priority_id', '=', 'priorities.id')
            ->select('priorities.name', DB::raw('count(*) as count'))
            ->groupBy('priorities.name')
            ->pluck('count', 'name');

        // 4. Tasks by Category
        $tasksByCategory = $user->tasks()
            ->join('categories', 'tasks.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('count(*) as count'))
            ->groupBy('categories.name')
            ->pluck('count', 'name');

        return view('stats.index', compact('totalTasks', 'completedTasks', 'completionRate', 'chartData', 'tasksByPriority', 'tasksByCategory'));
    }
}
