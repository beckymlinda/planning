<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Department;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('department.outcome.goal.pillar')->get();
        return view('dashboard.director.activities.index', compact('activities'));
    }

    public function create()
    {
        $departments = Department::with('outcome.goal.pillar')->get();
        return view('dashboard.director.activities.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:activities,code',
            'description' => 'nullable|string',
            'budget_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:planned,ongoing,completed,cancelled',
            'budget_year' => 'required|integer|min:2020|max:' . (date('Y') + 5),
        ]);

        Activity::create($request->all());

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }

    public function show(Activity $activity)
    {
        $activity->load('department.outcome.goal.pillar', 'budgetItems', 'payments');
        return view('dashboard.director.activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        $departments = Department::with('outcome.goal.pillar')->get();
        return view('dashboard.director.activities.edit', compact('activity', 'departments'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:activities,code,' . $activity->id,
            'description' => 'nullable|string',
            'budget_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:planned,ongoing,completed,cancelled',
            'budget_year' => 'required|integer|min:2020|max:' . (date('Y') + 5),
        ]);

        $activity->update($request->all());

        return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }
}
