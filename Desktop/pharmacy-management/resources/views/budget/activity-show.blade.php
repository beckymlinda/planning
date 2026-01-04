@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h4 fw-bold text-purple">{{ $activity->name }}</h1>
                <p class="text-muted mb-0">
                    Department: {{ $activity->department->name }}
                    @if($activity->code) | Code: {{ $activity->code }} @endif
                </p>
            </div>
            <a href="{{ route('budget.activities') }}" class="btn btn-outline-secondary btn-sm">
                ← Back to Activities
            </a>
        </div>
    </div>

    <!-- Activity Summary Cards -->
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center py-3">
                <div class="text-muted small">Total Budget</div>
                <div class="h4 fw-bold">MWK {{ number_format($activity->budget_amount, 2) }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center py-3">
                <div class="text-muted small">Status</div>
                <div class="h4 fw-bold text-capitalize">{{ $activity->status }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center py-3">
                <div class="text-muted small">Budget Items</div>
                <div class="h4 fw-bold">{{ $activity->budgetItems->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Description -->
    @if($activity->description)
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h5 class="fw-semibold text-purple mb-2">Description</h5>
            <p class="text-muted">{{ $activity->description }}</p>
        </div>
    </div>
    @endif

    <!-- Budget Breakdown -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h5 class="fw-semibold text-purple mb-3">Budget Breakdown</h5>
            @if($activity->budgetItems->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Frequency</th>
                            <th>Unit Cost</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activity->budgetItems as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->name }}</td>
                            <td>{{ $item->unit_of_measure ?? 'N/A' }}</td>
                            <td>{{ number_format($item->quantity, 2) }}</td>
                            <td>{{ $item->frequency }}</td>
                            <td>MWK {{ number_format($item->unit_cost, 2) }}</td>
                            <td>MWK {{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="5" class="text-end fw-semibold">Total Budget Items:</td>
                            <td class="fw-bold">MWK {{ number_format($activity->budgetItems->sum('total'), 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @else
            <div class="text-center py-4 text-muted">No budget items found for this activity.</div>
            @endif
        </div>
    </div>

    <!-- Payment History -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-semibold text-purple mb-3">Payment History</h5>
            @if($activity->payments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Voucher #</th>
                            <th>Payee</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activity->payments as $payment)
                        @php
                            $statusClass = match($payment->status) {
                                'approved' => 'bg-success text-white',
                                'pending' => 'bg-warning text-dark',
                                default => 'bg-secondary text-white',
                            };
                        @endphp
                        <tr>
                            <td class="fw-semibold">{{ $payment->voucher_number }}</td>
                            <td>{{ $payment->payee }}</td>
                            <td>MWK {{ number_format($payment->amount, 2) }}</td>
                            <td>
                                <span class="badge {{ $statusClass }} text-capitalize px-2 py-1">
                                    {{ $payment->status }}
                                </span>
                            </td>
                            <td class="text-muted">{{ $payment->payment_date->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="2" class="text-end fw-semibold">Total Payments:</td>
                            <td class="fw-bold">MWK {{ number_format($activity->payments->sum('amount'), 2) }}</td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @else
            <div class="text-center py-4 text-muted">No payments found for this activity.</div>
            @endif
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .text-purple { color: #5B2C6F !important; }
    .fw-semibold { font-weight: 600 !important; }
    .table-hover tbody tr:hover { background-color: #f2f0f7; }
    .badge.bg-warning { background-color: #F39C12 !important; }
</style>
@endsection
