<?php

namespace App\Http\Controllers;

use App\Models\BudgetItem;
use App\Models\Activity;
use Illuminate\Http\Request;

class BudgetItemController extends Controller
{
    public function index()
    {
        $budgetItems = BudgetItem::with('activity.department.outcome.goal.pillar')->get();
        return view('dashboard.director.budget-items.index', compact('budgetItems'));
    }

    public function create()
    {
        $activities = Activity::with('department.outcome.goal.pillar')->get();
        return view('dashboard.director.budget-items.create', compact('activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'name' => 'required|string|max:255',
            'unit_of_measure' => 'required|string|max:50',
            'quantity' => 'required|numeric|min:0',
            'frequency' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        BudgetItem::create($request->all());

        return redirect()->route('budget-items.index')->with('success', 'Budget item created successfully.');
    }

    public function show(BudgetItem $budgetItem)
    {
        $budgetItem->load('activity.department.outcome.goal.pillar');
        return view('dashboard.director.budget-items.show', compact('budgetItem'));
    }

    public function edit(BudgetItem $budgetItem)
    {
        $activities = Activity::with('department.outcome.goal.pillar')->get();
        return view('dashboard.director.budget-items.edit', compact('budgetItem', 'activities'));
    }

    public function update(Request $request, BudgetItem $budgetItem)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'name' => 'required|string|max:255',
            'unit_of_measure' => 'required|string|max:50',
            'quantity' => 'required|numeric|min:0',
            'frequency' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $budgetItem->update($request->all());

        return redirect()->route('budget-items.index')->with('success', 'Budget item updated successfully.');
    }

    public function destroy(BudgetItem $budgetItem)
    {
        $budgetItem->delete();

        return redirect()->route('budget-items.index')->with('success', 'Budget item deleted successfully.');
    }
}
