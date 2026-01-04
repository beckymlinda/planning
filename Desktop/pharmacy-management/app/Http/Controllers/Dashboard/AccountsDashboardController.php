<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountsDashboardController extends Controller
{
    public function index()
    {
        $totalPayments = Payment::count();
        $totalAmount = Payment::sum('amount');
        $pendingPayments = Payment::where('status', 'pending')->count();
        $approvedPayments = Payment::where('status', 'approved')->count();
        
        $recentPayments = Payment::with('activity.department')
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.accounts.index', compact(
            'totalPayments',
            'totalAmount',
            'pendingPayments',
            'approvedPayments',
            'recentPayments'
        ));
    }

    public function paymentDetails($id)
    {
        $payment = Payment::with('activity.department')
            ->findOrFail($id);

        return view('dashboard.accounts.payment-details', compact('payment'));
    }

    public function createPayment()
    {
        $activities = Activity::with('department')->get();

        return view('dashboard.accounts.create-payment', compact('activities'));
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'voucher_number' => 'required|unique:payments,voucher_number',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payee' => 'required|string',
            'description' => 'nullable|string',
            'bank_slip' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'receipt' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'invoice' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $payment = Payment::create([
            'activity_id' => $request->activity_id,
            'voucher_number' => $request->voucher_number,
            'payment_date' => $request->payment_date,
            'amount' => $request->amount,
            'payee' => $request->payee,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        if ($request->hasFile('bank_slip')) {
            $payment->bank_slip_path = $request->file('bank_slip')->store('payments/bank_slips');
            $payment->save();
        }

        if ($request->hasFile('receipt')) {
            $payment->receipt_path = $request->file('receipt')->store('payments/receipts');
            $payment->save();
        }

        if ($request->hasFile('invoice')) {
            $payment->invoice_path = $request->file('invoice')->store('payments/invoices');
            $payment->save();
        }

        return redirect()->route('accounts.dashboard')->with('success', 'Payment created successfully.');
    }
}

