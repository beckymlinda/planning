<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Outcome;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('outcome.goal.pillar')->get();
        return view('dashboard.director.departments.index', compact('departments'));
    }

    public function create()
    {
        $outcomes = Outcome::with('goal.pillar')->get();
        return view('dashboard.director.departments.create', compact('outcomes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'outcome_id' => 'required|exists:outcomes,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:departments,code',
            'description' => 'nullable|string',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function show(Department $department)
    {
        $department->load('outcome.goal.pillar', 'activities', 'users');
        return view('dashboard.director.departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        $outcomes = Outcome::with('goal.pillar')->get();
        return view('dashboard.director.departments.edit', compact('department', 'outcomes'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'outcome_id' => 'required|exists:outcomes,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:departments,code,' . $department->id,
            'description' => 'nullable|string',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
