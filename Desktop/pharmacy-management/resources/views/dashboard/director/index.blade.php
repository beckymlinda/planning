@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Dashboard Header -->
    <div class="mb-4">
        <h1 class="h4 fw-bold text-purple">Director Dashboard</h1>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-semibold text-muted">Total Activities</h6>
                    <p class="h5 fw-bold mb-0">{{ $totalActivities }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-semibold text-muted">Total Budget</h6>
                    <p class="h5 fw-bold mb-0">MWK {{ number_format($totalBudget, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-semibold text-muted">Total Payments</h6>
                    <p class="h5 fw-bold mb-0">MWK {{ number_format($totalPayments, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="fw-semibold text-muted">Pending Approvals</h6>
                    <p class="h5 fw-bold mb-0">{{ $pendingApprovals }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Payments Table -->
    <div class="card shadow-sm border-0">
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
                            <th>Actions</th>
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
                            <td>
                                @if($payment->status === 'pending')
                                <div class="btn-group btn-group-sm" role="group">
                                    <form method="POST" action="{{ route('director.approve-payment', $payment->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('director.reject-payment', $payment->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this payment?')">Reject</button>
                                    </form>
                                </div>
                                @elseif($payment->status === 'approved')
                                <form method="POST" action="{{ route('director.revert-payment', $payment->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to revert this approved payment?')">Revert</button>
                                </form>
                                @else
                                <span class="text-muted">No actions available</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No payments found.</td>
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
    .btn-orange {
        background-color: #F39C12;
        color: white;
    }
    .btn-orange:hover {
        background-color: #d78f0e;
        color: white;
    }
    .badge { text-transform: capitalize; }
</style>
@endsection
