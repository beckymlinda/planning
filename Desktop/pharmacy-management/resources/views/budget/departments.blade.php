@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h1 class="h4 fw-bold text-purple">Departments</h1>
            <p class="text-muted mb-0">Overview of all departments and their budget allocations</p>
        </div>
    </div>

    <!-- Departments Grid -->
    <div class="row g-3">
        @foreach($departments as $department)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="fw-semibold mb-0">{{ $department->name }}</h5>
                            <span class="text-muted small">{{ $department->code }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-sm mb-1">
                            <span class="text-muted">Activities:</span>
                            <span class="fw-semibold">{{ $department->activities->count() }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-sm">
                            <span class="text-muted">Total Budget:</span>
                            <span class="fw-semibold">MWK {{ number_format($department->activities->sum('budget_amount'), 2) }}</span>
                        </div>

                        @if($department->outcome)
                        <div class="text-muted small mt-2">
                            <div>Pillar: {{ $department->outcome->goal->pillar->name }}</div>
                            <div>Goal: {{ $department->outcome->goal->name }}</div>
                            <div>Outcome: {{ $department->outcome->name }}</div>
                        </div>
                        @endif
                    </div>

                    <a href="{{ route('budget.department.show', $department->id) }}"
                       class="btn btn-orange btn-sm mt-auto">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Custom CSS for NCHE Theme -->
<style>
    .text-purple { color: #5B2C6F !important; }
    .btn-orange { 
        background-color: #F39C12; 
        color: white; 
    }
    .btn-orange:hover {
        background-color: #d78f0e; 
        color: white;
    }
    .fw-semibold { font-weight: 600 !important; }
    .card:hover { transform: translateY(-2px); transition: 0.2s; }
</style>
@endsection
