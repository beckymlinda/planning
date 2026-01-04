<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Activity;
use App\Models\BudgetItem;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function departments()
    {
        $departments = Department::with('outcome.goal.pillar', 'activities')->get();

        return view('budget.departments', compact('departments'));
    }

    public function activities()
    {
        $activities = Activity::with('department.outcome.goal.pillar', 'budgetItems')->get();

        return view('budget.activities', compact('activities'));
    }

    public function budgetItems()
    {
        $budgetItems = BudgetItem::with('activity.department')->get();

        return view('budget.budget-items', compact('budgetItems'));
    }

    public function showDepartment($id)
    {
        $department = Department::with('outcome.goal.pillar', 'activities.budgetItems', 'users')->findOrFail($id);

        return view('budget.department-show', compact('department'));
    }

    public function showActivity($id)
    {
        $activity = Activity::with('department.outcome.goal.pillar', 'budgetItems', 'payments')->findOrFail($id);

        return view('budget.activity-show', compact('activity'));
    }
}