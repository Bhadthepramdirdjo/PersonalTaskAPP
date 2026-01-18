<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        Auth::user()->categories()->create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if used by tasks
        if ($category->tasks()->count() > 0) {
            return back()->with('error', 'Cannot delete category because it is used by active tasks.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}
