@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-purple">Payment Details</h4>
        <a href="{{ route('accounts.dashboard') }}" class="btn btn-outline-secondary btn-sm">
            ← Back to Dashboard
        </a>
    </div>

    <!-- Payment Summary Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3">

                <div class="col-md-4">
                    <small class="text-muted">Voucher Number</small>
                    <div class="fw-semibold">{{ $payment->voucher_number }}</div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Payee</small>
                    <div class="fw-semibold">{{ $payment->payee }}</div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Amount</small>
                    <div class="fw-bold text-orange">
                        MWK {{ number_format($payment->amount,2) }}
                    </div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Activity</small>
                    <div class="fw-semibold">{{ $payment->activity->name }}</div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Department</small>
                    <div class="fw-semibold">{{ $payment->activity->department->name }}</div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Payment Date</small>
                    <div class="fw-semibold">{{ $payment->payment_date->format('Y-m-d') }}</div>
                </div>

                <div class="col-md-4">
                    <small class="text-muted">Status</small>
                    <div>
                        @if($payment->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($payment->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($payment->status) }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-8">
                    <small class="text-muted">Description</small>
                    <div class="fw-semibold">
                        {{ $payment->description ?? 'N/A' }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Documents -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold text-purple">
            Supporting Documents
        </div>
        <div class="card-body">

            <div class="row g-3">

                @if($payment->bank_slip_path)
                <div class="col-md-4">
                    <a href="{{ Storage::url($payment->bank_slip_path) }}" target="_blank"
                       class="btn btn-outline-primary w-100">
                        View Bank Slip
                    </a>
                </div>
                @endif

                @if($payment->receipt_path)
                <div class="col-md-4">
                    <a href="{{ Storage::url($payment->receipt_path) }}" target="_blank"
                       class="btn btn-outline-success w-100">
                        View Receipt
                    </a>
                </div>
                @endif

                @if($payment->invoice_path)
                <div class="col-md-4">
                    <a href="{{ Storage::url($payment->invoice_path) }}" target="_blank"
                       class="btn btn-outline-warning w-100">
                        View Invoice
                    </a>
                </div>
                @endif

                @if(!$payment->bank_slip_path && !$payment->receipt_path && !$payment->invoice_path)
                <div class="col-12 text-center text-muted">
                    No documents uploaded
                </div>
                @endif

            </div>

        </div>
    </div>

</div>

<style>
.text-purple { color:#5B2C6F; }
.text-orange { color:#F39C12; }
</style>
@endsection
