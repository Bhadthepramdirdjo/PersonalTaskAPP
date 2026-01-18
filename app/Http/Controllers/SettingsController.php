<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $settings = UserSetting::firstOrCreate(
            ['user_id' => $user->id],
            ['default_reminder_type' => 'none', 'email_notification' => true]
        );

        return view('settings.edit', compact('user', 'settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'default_reminder_type' => 'required|in:none,2_jam,1_hari,2_hari,3_hari',
            'email_notification' => 'required|boolean',
            'email_template' => 'nullable|string',
            'language' => 'required|in:en,id',
        ]);

        $user = Auth::user();

        UserSetting::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return back()->with('success', 'Settings updated successfully.');
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048', // 2MB Max
        ]);

        $user = Auth::user();

        if ($request->file('photo')) {
            // Delete old photo if exists
            if ($user->profile_photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_photo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo);
            }
            
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->update(['profile_photo' => $path]);
        }

        return back()->with('success', 'Profile photo updated successfully.');
    }

    public function sendTestEmail()
    {
        // Create a dummy task for testing
        $user = Auth::user();
        $dummyTask = new \App\Models\Task([
            'title' => 'Test Task Verification',
            'description' => 'This is a test task to verify your email settings.',
            'deadline' => now()->addDay(),
            'user_id' => $user->id,
        ]);
        // We need to manually set the relation for the view
        $dummyTask->setRelation('user', $user);

        // Send Email
        try {
             \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\TaskReminder($dummyTask));
             return back()->with('success', 'Test email sent successfully to ' . $user->email);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }
}
