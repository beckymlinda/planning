@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Activity Details</h4>
                    <div>
                        <a href="{{ route('activities.edit', $activity) }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('activities.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back to Activities
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">ID</label>
                                <p class="form-control-plaintext">{{ $activity->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Code</label>
                                <p class="form-control-plaintext">{{ $activity->code }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <p class="form-control-plaintext">{{ $activity->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Department</label>
                                <p class="form-control-plaintext">{{ $activity->department->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Budget Year</label>
                                <p class="form-control-plaintext">{{ $activity->budget_year }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p class="form-control-plaintext">MWK {{ number_format($activity->budget_amount, 2) }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-{{ $activity->status == 'completed' ? 'success' : ($activity->status == 'ongoing' ? 'primary' : 'secondary') }}">
                                        {{ ucfirst($activity->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Start Date</label>
                                <p class="form-control-plaintext">{{ $activity->start_date ? $activity->start_date->format('Y-m-d') : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">End Date</label>
                                <p class="form-control-plaintext">{{ $activity->end_date ? $activity->end_date->format('Y-m-d') : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <p class="form-control-plaintext">{{ $activity->description ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Budget Items</label>
                        <ul class="list-group">
                            @forelse($activity->budgetItems as $item)
                            <li class="list-group-item">{{ $item->name }} - MWK {{ number_format($item->total, 2) }}</li>
                            @empty
                            <li class="list-group-item text-muted">No budget items associated.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Payments</label>
                        <ul class="list-group">
                            @forelse($activity->payments as $payment)
                            <li class="list-group-item">{{ $payment->payee }} - MWK {{ number_format($payment->amount, 2) }}</li>
                            @empty
                            <li class="list-group-item text-muted">No payments associated.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection