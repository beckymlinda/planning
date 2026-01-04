@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h4 fw-bold text-purple">{{ $department->name }}</h1>
                <p class="text-muted mb-0">Department Code: {{ $department->code }}</p>
            </div>
            <a href="{{ route('budget.departments') }}" class="btn btn-outline-secondary btn-sm">
                ← Back to Departments
            </a>
        </div>
    </div>

    <!-- Strategic Context -->
    @if($department->outcome)
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h5 class="fw-semibold text-purple mb-3">Strategic Context</h5>
            <div class="row text-center text-md-start">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="text-muted small">Pillar</div>
                    <div class="fw-semibold">{{ $department->outcome->goal->pillar->name }}</div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="text-muted small">Goal</div>
                    <div class="fw-semibold">{{ $department->outcome->goal->name }}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-muted small">Outcome</div>
                    <div class="fw-semibold">{{ $department->outcome->name }}</div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Activities -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h5 class="fw-semibold text-purple mb-3">Activities</h5>
            <div class="row g-3">
                @forelse($department->activities as $activity)
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-semibold mb-0">{{ $activity->name }}</h6>
                                    <span class="text-muted small">{{ $activity->code }}</span>
                                </div>
                                <div class="d-flex justify-content-between text-sm mb-1">
                                    <span class="text-muted">Budget Amount:</span>
                                    <span class="fw-semibold">MWK {{ number_format($activity->budget_amount, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between text-sm">
                                    <span class="text-muted">Status:</span>
                                    <span class="fw-semibold text-capitalize">{{ $activity->status }}</span>
                                </div>
                            </div>
                            <a href="{{ route('budget.activity.show', $activity->id) }}"
                               class="btn btn-orange btn-sm mt-auto">View Activity Details</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4 text-muted">
                    No activities found for this department.
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Department Users -->
    @if($department->users->count() > 0)
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-semibold text-purple mb-3">Department Users</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($department->users as $user)
                        <tr>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-capitalize">{{ $user->role }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Custom CSS -->
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
    .table-hover tbody tr:hover { background-color: #f2f0f7; } /* subtle purple hover */
</style>
@endsection
