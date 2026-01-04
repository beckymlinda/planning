@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-purple">
            Create New Payment
        </h4>
        <a href="{{ route('accounts.dashboard') }}" class="btn btn-outline-secondary btn-sm">
            ← Back to Payments
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-purple text-white fw-semibold">
            Payment Information
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('accounts.store-payment') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    <!-- Activity -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Activity</label>
                        <select name="activity_id" class="form-select" required>
                            <option value="">Select Activity</option>
                            @foreach($activities as $activity)
                                <option value="{{ $activity->id }}" {{ old('activity_id') == $activity->id ? 'selected' : '' }}>
                                    {{ $activity->name }} — {{ $activity->department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('activity_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Voucher -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Voucher Number</label>
                        <input type="text" name="voucher_number" value="{{ old('voucher_number') }}"
                               class="form-control" required>
                        @error('voucher_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Payment Date</label>
                        <input type="date" name="payment_date" value="{{ old('payment_date') }}"
                               class="form-control" required>
                        @error('payment_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Amount (MWK)</label>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount') }}"
                               class="form-control" required>
                        @error('amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Payee -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Payee</label>
                        <input type="text" name="payee" value="{{ old('payee') }}"
                               class="form-control" required>
                        @error('payee')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <!-- Invoice -->
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Invoice (optional)</label>
                        <input type="file" name="invoice" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                        <small class="text-muted">PDF, JPG, JPEG or PNG</small>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('accounts.dashboard') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-orange">
                        Save Payment
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<style>
.text-purple { color:#5B2C6F; }
.bg-purple { background:#5B2C6F; }
.btn-orange {
    background:#F39C12;
    color:#fff;
    border:none;
}
.btn-orange:hover {
    background:#d68910;
    color:#fff;
}
</style>
@endsection
