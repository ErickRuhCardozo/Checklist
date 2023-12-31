<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scan;
use Illuminate\Support\Facades\View;

class ScanController extends Controller
{
    public function show(Scan $scan)
    {
        $tasks = $scan->place->tasks->where(fn($task) => $task->period->value === $scan->checklist->user->work_period->value);
        $tasksDone = $scan->tasksDone()->map(fn($scanTask) => $scanTask->task->id)->toArray();

        return View::make('admin.scans.show', [
            'scan' => $scan,
            'tasks' => $tasks,
            'tasksDone' => $tasksDone,
        ]);
    }
}
