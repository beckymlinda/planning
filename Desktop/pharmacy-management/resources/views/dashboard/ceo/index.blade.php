@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Dashboard Header -->
    <div class="mb-4">
        <h1 class="h4 fw-bold text-purple">CEO Dashboard</h1>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-2 col-sm-6">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-semibold text-muted">Total Departments</h6>
                    <p class="h5 fw-bold mb-0">{{ $totalDepartments }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-semibold text-muted">Total Activities</h6>
                    <p class="h5 fw-bold mb-0">{{ $totalActivities }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-semibold text-muted">Total Budget</h6>
                    <p class="h5 fw-bold mb-0">MWK {{ number_format($totalBudget, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-semibold text-muted">Total Payments</h6>
                    <p class="h5 fw-bold mb-0">MWK {{ number_format($totalPayments, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-semibold text-muted">Pending Payments</h6>
                    <p class="h5 fw-bold mb-0">{{ $pendingPayments }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Payments Table -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h5 class="fw-semibold text-purple mb-3">Recent Payments</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Voucher #</th>
                            <th>Activity</th>
                            <th>Department</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPayments as $payment)
                        <tr>
                            <td>{{ $payment->voucher_number }}</td>
                            <td>{{ $payment->activity->name }}</td>
                            <td>{{ $payment->activity->department->name }}</td>
                            <td>MWK {{ number_format($payment->amount, 2) }}</td>
                            <td>
                                <span class="badge 
                                    @if($payment->status === 'approved') bg-success 
                                    @elseif($payment->status === 'pending') bg-warning text-dark 
                                    @else bg-secondary @endif">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No payments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Departments Overview Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-semibold text-purple mb-3">Departments Overview</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Department</th>
                            <th>Activities</th>
                            <th>Total Budget</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $dept)
                        <tr>
                            <td>{{ $dept->name }}</td>
                            <td>{{ $dept->activities_count }}</td>
                            <td>MWK {{ number_format($dept->activities_sum_budget_amount ?? 0, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No departments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for NCHE Theme -->
<style>
    .text-purple { color: #5B2C6F !important; }
    .fw-semibold { font-weight: 600 !important; }
    .table-hover tbody tr:hover { background-color: #f2f0f7; } /* subtle purple hover */
    .badge { text-transform: capitalize; }
</style>
@endsection
