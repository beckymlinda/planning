@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Budget Item Details</h4>
                    <div>
                        <a href="{{ route('budget-items.edit', $budgetItem) }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('budget-items.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back to Budget Items
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">ID</label>
                                <p class="form-control-plaintext">{{ $budgetItem->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <p class="form-control-plaintext">{{ $budgetItem->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Activity</label>
                        <p class="form-control-plaintext">
                            {{ $budgetItem->activity->name }} ({{ $budgetItem->activity->department->name }} - {{ $budgetItem->activity->department->outcome->name }} - {{ $budgetItem->activity->department->outcome->goal->name }} - {{ $budgetItem->activity->department->outcome->goal->pillar->name }})
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Unit of Measure</label>
                                <p class="form-control-plaintext">{{ $budgetItem->unit_of_measure }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <p class="form-control-plaintext">{{ $budgetItem->quantity }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Frequency</label>
                                <p class="form-control-plaintext">{{ $budgetItem->frequency }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Unit Cost (MWK)</label>
                                <p class="form-control-plaintext">{{ number_format($budgetItem->unit_cost, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Total (MWK)</label>
                        <p class="form-control-plaintext">{{ number_format($budgetItem->total, 2) }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <p class="form-control-plaintext">{{ $budgetItem->description ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection