@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0 text-purple">Accounts Dashboard</h4>
        <span class="text-muted small">Financial overview</span>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Total Payments</small>
                    <h4 class="fw-bold text-purple">{{ $totalPayments }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Total Amount</small>
                    <h4 class="fw-bold text-purple">MWK {{ number_format($totalAmount,2) }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-start border-4 border-warning shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Pending Payments</small>
                    <h4 class="fw-bold text-warning">{{ $pendingPayments }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-start border-4 border-success shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Approved Payments</small>
                    <h4 class="fw-bold text-success">{{ $approvedPayments }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h6 class="fw-bold mb-0 text-purple">Recent Payments</h6>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Voucher #</th>
                        <th>Activity</th>
                        <th>Department</th>
                        <th>Payee</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPayments as $payment)
                    <tr>
                        <td class="fw-semibold">{{ $payment->voucher_number }}</td>
                        <td>{{ $payment->activity->name }}</td>
                        <td>{{ $payment->activity->department->name }}</td>
                        <td>{{ $payment->payee }}</td>
                        <td>MWK {{ number_format($payment->amount,2) }}</td>
                        <td>
                            @if($payment->status=='approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($payment->status=='pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($payment->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
                        <td class="text-end">
                            <a href="{{ route('accounts.payment-details',$payment->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No payments found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<style>
.text-purple { color:#5B2C6F; }
</style>

@endsection

