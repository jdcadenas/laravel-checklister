<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Checklist;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTaskRequest;
use \Illuminate\Contracts\View\View;

class TaskController extends Controller
{
    public function store(StoreTaskRequest $request, Checklist $checklist): RedirectResponse
    {
        $validated = $request->validated();
        $position = $checklist->tasks()->max('position') + 1;
        $checklist->tasks()->create($request->validated() + ['position' => $position]);
        return redirect()->route('admin.checklist_groups.checklists.edit', [$checklist->checklist_group_id, $checklist]);
    }

    public function edit(Checklist $checklist, Task $task): View
    {
        return view('admin.tasks.edit', compact('checklist', 'task'));
    }

    public function update(StoreTaskRequest $request, Checklist $checklist, Task $task): RedirectResponse
    {
        $task->update($request->validated());
        return redirect()->route('admin.checklist_groups.checklists.edit', [$checklist->checklist_group_id, $checklist]);
    }

    public function destroy(Checklist $checklist, Task $task): RedirectResponse
    {
        $checklist->tasks()->where('position', '>', $task->position)->update(
            ['position' => \DB::raw('position - 1')]
        );

        $task->delete();

        return redirect()->route('admin.checklist_groups.checklists.edit', [
            $checklist->checklist_group_id, $checklist
        ]);
    }
}
