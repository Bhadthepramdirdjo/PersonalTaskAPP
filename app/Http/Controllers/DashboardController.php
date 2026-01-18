<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'completed' => $user->tasks()->where('is_completed', true)->count(),
            'pending' => $user->tasks()->where('is_completed', false)->count(),
            'overdue' => $user->tasks()->where('is_completed', false)->where('deadline', '<', now())->count(),
        ];

        $todayTasks = $user->tasks()
            ->whereDate('deadline', today())
            ->where('is_completed', false)
            ->with(['priority', 'category'])
            ->orderBy('priority_id', 'desc')
            ->get();

        $upcomingTasks = $user->tasks()
            ->where('deadline', '>', now())
            // ->where('deadline', '<=', now()->addDays(3)) // Optional limit
            ->where('is_completed', false)
            ->with(['priority', 'category'])
            ->orderBy('deadline')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'todayTasks', 'upcomingTasks'));
    }
}
