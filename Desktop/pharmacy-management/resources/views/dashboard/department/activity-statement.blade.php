@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Activity Statement: {{ $activity->name }}</h1>
    
    <div class="activity-info">
        <div class="detail-row">
            <strong>Department:</strong>
            <span>{{ $activity->department->name }}</span>
        </div>
        <div class="detail-row">
            <strong>Budget Amount:</strong>
            <span>MWK {{ number_format($activity->budget_amount, 2) }}</span>
        </div>
        <div class="detail-row">
            <strong>Total Spent:</strong>
            <span>MWK {{ number_format($activity->total_paid, 2) }}</span>
        </div>
        <div class="detail-row">
            <strong>Remaining:</strong>
            <span>MWK {{ number_format($activity->remaining_budget, 2) }}</span>
        </div>
        <div class="detail-row">
            <strong>Status:</strong>
            <span class="badge badge-{{ $activity->status }}">{{ $activity->status }}</span>
        </div>
    </div>

    <div class="section">
        <h2>Budget Items</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activity->budgetItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->quantity, 2) }}</td>
                    <td>MWK {{ number_format($item->unit_price, 2) }}</td>
                    <td>MWK {{ number_format($item->amount, 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No budget items found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Payments</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Voucher #</th>
                    <th>Payee</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activity->payments as $payment)
                <tr>
                    <td>{{ $payment->voucher_number }}</td>
                    <td>{{ $payment->payee }}</td>
                    <td>MWK {{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
                    <td><span class="badge badge-{{ $payment->status }}">{{ $payment->status }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No payments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('department.dashboard') }}" class="btn-back">Back to Dashboard</a>
</div>
@endsection

