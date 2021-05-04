<?php

namespace App\Http\Controllers\Admin;

use App\Models\ChecklistGroup;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChecklistGroupRequest;
use Illuminate\Http\RedirectResponse;

class ChecklistGroupController extends Controller
{

    public function create(): View
    {
        return view('admin.checklist_groups.create');
    }

    public function store(StoreChecklistGroupRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        ChecklistGroup::create($validated);
        return redirect()->route('home');
    }

    public function edit(ChecklistGroup $checklistGroup): View
    {
        return view('admin.checklist_groups.edit', compact('checklistGroup'));
    }

    public function update(StoreChecklistGroupRequest $request, ChecklistGroup $checklistGroup): RedirectResponse
    {
        $validated = $request->validated();
        $checklistGroup->update($validated);
        return redirect('home');
    }

    public function destroy(ChecklistGroup $checklistGroup): RedirectResponse
    {
        $checklistGroup->delete();
        return redirect()->route('home');
    }
}
