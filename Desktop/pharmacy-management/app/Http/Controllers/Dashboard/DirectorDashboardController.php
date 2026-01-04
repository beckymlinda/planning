<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Payment;
use App\Models\Department;
use Illuminate\Http\Request;

class DirectorDashboardController extends Controller
{
    public function index()
    {
        $totalActivities = Activity::count();
        $totalBudget = Activity::sum('budget_amount');
        $totalPayments = Payment::sum('amount');
        $pendingApprovals = Payment::where('status', 'pending')->count();
        
        $recentPayments = Payment::with('activity.department')
            ->latest()
            ->take(10)
            ->get();

        $departments = Department::withCount('activities')
            ->withSum('activities', 'budget_amount')
            ->get();

        return view('dashboard.director.index', compact(
            'totalActivities',
            'totalBudget',
            'totalPayments',
            'pendingApprovals',
            'recentPayments',
            'departments'
        ));
    }

    public function approvePayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        
        $payment->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Payment approved successfully.');
    }

    public function rejectPayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        
        $payment->update([
            'status' => 'rejected',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Payment rejected.');
    }

    public function revertPayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        
        $payment->update([
            'status' => 'pending',
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return redirect()->back()->with('success', 'Payment approval reverted. Status changed back to pending.');
    }
}

