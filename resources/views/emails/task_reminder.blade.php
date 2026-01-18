<!DOCTYPE html>
<html>
<head>
    <title>Task Reminder</title>
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #1e3a8a;">Reminder: {{ $task->title }}</h2>
        
        @if(!empty($template))
            <div style="color: #4b5563; white-space: pre-line;">
                {{ str_replace(
                    ['{name}', '{title}', '{deadline}', '{description}'], 
                    [optional($task->user)->name ?? 'User', $task->title, $task->deadline->format('l, d F Y H:i'), $task->description ?? 'No description'], 
                    $template
                ) }}
            </div>
        @else
            <h1 style="color: #1e3a8a; font-size: 24px; margin-bottom: 20px;">Task Reminder</h1>
            <p style="color: #374151; font-size: 16px; line-height: 1.6;">Dear <strong>{{ optional($task->user)->name ?? 'User' }}</strong>,</p>
            
            <p style="color: #374151; font-size: 16px; line-height: 1.6;">This is an automated notification to remind you of an upcoming deadling for the following task:</p>
            
            <div style="background-color: #f3f4f6; border-left: 4px solid #2563eb; padding: 20px; margin: 25px 0; border-radius: 4px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 5px 0; color: #6b7280; font-size: 14px; width: 100px;">Task Title</td>
                        <td style="padding: 5px 0; color: #111827; font-size: 16px; font-weight: bold;">{{ $task->title }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0; color: #6b7280; font-size: 14px;">Due Date</td>
                        <td style="padding: 5px 0; color: #dc2626; font-size: 16px; font-weight: bold;">{{ $task->deadline->format('l, d F Y') }} <span style="color: #6b7280; font-weight: normal;">at {{ $task->deadline->format('H:i') }}</span></td>
                    </tr>
                    @if($task->description)
                    <tr>
                        <td style="padding: 15px 0 5px; color: #6b7280; font-size: 14px; vertical-align: top;" colspan="2">Description:</td>
                    </tr>
                    <tr>
                        <td style="padding: 0; color: #374151; font-size: 15px; line-height: 1.5; font-style: italic;" colspan="2">{{ $task->description }}</td>
                    </tr>
                    @endif
                </table>
            </div>

            <p style="color: #374151; font-size: 16px; line-height: 1.6;">Please ensure this task is addressed before the scheduled deadline.</p>
            
            <p style="color: #374151; font-size: 16px; line-height: 1.6; margin-top: 30px;">
                Best Regards,<br>
                <strong>Task-APP Team</strong>
            </p>
        @endif

        <p style="text-align: center; margin-top: 30px;">
            <a href="{{ route('tasks.index') }}" style="background-color: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">View Task</a>
        </p>
    </div>
</body>
</html>
