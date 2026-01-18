<?php

namespace App\Console\Commands;

use App\Mail\TaskReminder;
use App\Models\Reminder;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendTaskReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for due reminders and send emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $this->info("Checking for reminders due before: " . $now);

        $reminders = Reminder::where('is_active', true)
            ->where('is_sent', false)
            ->where('reminder_time', '<=', $now)
            // ->with(['task.user']) // Disable eager loading to prevent crashes on bad data
            ->get();

        $count = 0;

        foreach ($reminders as $reminder) {
            $this->info("Processing Reminder ID: {$reminder->id}");
            try {
                $task = $reminder->task;
                
                if (!$task) {
                    $this->warn("Skipping: Task not found for reminder {$reminder->id}");
                    continue;
                }
                
                if ($task->is_completed) {
                    $this->info("Skipping: Task completed.");
                    $reminder->is_sent = true;
                    $reminder->save();
                    continue;
                }

                if (!$task->user) {
                     $this->error("Skipping: User not found for task {$task->id}");
                     continue;
                }

                // Check user setting
                $userSettings = \App\Models\UserSetting::where('user_id', $task->user_id)->first();
                $shouldSend = $userSettings ? $userSettings->email_notification : true;

                if ($shouldSend) {
                    try {
                        Mail::to($task->user->email)->send(new TaskReminder($task));
                        $this->info("Sent reminder for task: {$task->title}");
                    } catch (\Exception $e) {
                         $this->error("Failed to send email: " . $e->getMessage());
                    }
                } else {
                     $this->info("Skipped (User disabled notifications): {$task->title}");
                }

                $reminder->is_sent = true;
                $reminder->save();
                $count++;
            } catch (\Exception $e) {
                $this->error("CRITICAL ERROR processing reminder {$reminder->id}: " . $e->getMessage());
            }
        }

        $this->info("Processed {$count} reminders.");
    }
}
