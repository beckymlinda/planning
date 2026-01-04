<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Payment;
use App\Models\BudgetItem;
use Illuminate\Http\Request;

class DepartmentDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if (!$user->department_id) {
            return view('dashboard.department.index', [
                'activities' => collect(),
                'totalBudget' => 0,
                'totalSpent' => 0,
                'remainingBudget' => 0,
            ]);
        }

        $activities = Activity::where('department_id', $user->department_id)
            ->with(['budgetItems', 'payments'])
            ->get();

        $totalBudget = $activities->sum('budget_amount');
        $totalSpent = $activities->sum(function ($activity) {
            return $activity->payments->sum('amount');
        });
        $remainingBudget = $totalBudget - $totalSpent;

        return view('dashboard.department.index', compact(
            'activities',
            'totalBudget',
            'totalSpent',
            'remainingBudget'
        ));
    }

    public function activityStatement($id)
    {
        $user = auth()->user();
        $activity = Activity::where('id', $id)
            ->where('department_id', $user->department_id)
            ->with(['budgetItems', 'payments', 'department'])
            ->firstOrFail();

        return view('dashboard.department.activity-statement', compact('activity'));
    }
}

