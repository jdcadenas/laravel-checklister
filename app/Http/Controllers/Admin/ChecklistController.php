<?php

namespace App\Http\Controllers\Admin;

use App\Models\Checklist;
use App\Models\ChecklistGroup;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChecklistRequest;
use Illuminate\Http\RedirectResponse;

class ChecklistController extends Controller
{

    public function create(ChecklistGroup $checklistGroup): View
    {
        return view('admin.checklists.create', compact('checklistGroup'));
    }

    public function store(StoreChecklistRequest $request, ChecklistGroup $checklistGroup): RedirectResponse
    {
        $validated = $request->validated();

        $checklistGroup->checklists()->create($validated);

        return redirect()->route('home');
    }

    public function edit(ChecklistGroup $checklistGroup, Checklist $checklist): View
    {

        return view('admin.checklists.edit', compact('checklistGroup', 'checklist'));
    }

    public function update(StoreChecklistRequest $request, ChecklistGroup $checklistGroup, Checklist $checklist): RedirectResponse
    {
        $validated = $request->validated();
        $checklist->update($validated);
        return redirect()->route('home');
    }

    public function destroy(ChecklistGroup $checklistGroup, Checklist $checklist): RedirectResponse
    {
        $checklist->delete();
        return redirect()->route('home');
    }
}
