<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Activity;
use App\Models\Payment;
use Illuminate\Http\Request;

class CEODashboardController extends Controller
{
    public function index()
    {
        $totalDepartments = Department::count();
        $totalActivities = Activity::count();
        $totalBudget = Activity::sum('budget_amount');
        $totalPayments = Payment::sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->count();
        
        $recentPayments = Payment::with('activity.department')
            ->latest()
            ->take(10)
            ->get();

        $departments = Department::withCount('activities')
            ->withSum('activities', 'budget_amount')
            ->get();

        return view('dashboard.ceo.index', compact(
            'totalDepartments',
            'totalActivities',
            'totalBudget',
            'totalPayments',
            'pendingPayments',
            'recentPayments',
            'departments'
        ));
    }
}

