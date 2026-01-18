<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Task;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->tasks()->with(['category', 'priority', 'reminders']);

        // Filters
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->has('priority_id') && $request->priority_id) {
            $query->where('priority_id', $request->priority_id);
        }
        if ($request->has('status')) {
            if ($request->status === 'completed') {
                $query->where('is_completed', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_completed', false);
            }
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        // Sorting
        $sort = $request->get('sort', 'deadline');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        // Auto-cleanup: Delete tasks completed > 7 days ago
        $user->tasks()
            ->where('is_completed', true)
            ->where('completed_at', '<', now()->subDays(7))
            ->delete();

        $tasks = $query->get();
        $pendingTasks = $tasks->where('is_completed', false);
        // Limit completed displayed to 7
        $completedTasks = $user->tasks()
            ->where('is_completed', true)
            ->latest('completed_at')
            ->take(7)
            ->get();

        $categories = Category::where('user_id', $user->id)->get();
        $priorities = Priority::all();
        $labels = Label::where('user_id', $user->id)->get();

        return view('tasks.index', compact('pendingTasks', 'completedTasks', 'categories', 'priorities', 'labels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'deadline' => 'required|date',
            'priority_id' => 'required|exists:priorities,id',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'reminder_type' => 'nullable|in:none,2_jam,1_hari,2_hari,3_hari',
        ]);

        $user = Auth::user();
        $task = $user->tasks()->create($request->except('reminder_type'));

        // Handle Reminder
        if ($request->reminder_type && $request->reminder_type !== 'none') {
            $this->createOrUpdateReminder($task, $request->reminder_type);
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'deadline' => 'required|date',
            'priority_id' => 'required|exists:priorities,id',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'reminder_type' => 'nullable|in:none,2_jam,1_hari,2_hari,3_hari',
        ]);

        if($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update($request->except('reminder_type'));

        // Handle Reminder
        if ($request->reminder_type && $request->reminder_type !== 'none') {
            $this->createOrUpdateReminder($task, $request->reminder_type);
        } elseif ($request->reminder_type === 'none') {
            // Deactivate existing reminders
            $task->reminders()->update(['is_active' => false]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    private function createOrUpdateReminder(Task $task, $type)
    {
        $deadline = \Carbon\Carbon::parse($task->deadline);
        $reminderTime = match($type) {
            '2_jam' => $deadline->copy()->subHours(2),
            '1_hari' => $deadline->copy()->subDay(),
            '2_hari' => $deadline->copy()->subDays(2),
            '3_hari' => $deadline->copy()->subDays(3),
            default => $deadline->copy()->subHours(1), // Fallback
        };

        // Deactivate old active reminders
        $task->reminders()->where('is_active', true)->update(['is_active' => false]);

        // Create new
        \App\Models\Reminder::create([
            'task_id' => $task->id,
            'reminder_time' => $reminderTime,
            'reminder_type' => $type,
            'is_active' => true,
            'is_sent' => false,
        ]);
    }

    public function destroy(Task $task)
    {
        if($task->user_id !== Auth::id()) {
            abort(403);
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function toggleComplete(Task $task)
    {
        if($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->is_completed = !$task->is_completed;
        $task->completed_at = $task->is_completed ? now() : null;
        $task->save();

        return back()->with('success', 'Task status updated.');
    }
}
