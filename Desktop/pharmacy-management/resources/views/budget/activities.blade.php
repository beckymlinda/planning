@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body">
            <h1 class="h4 fw-bold text-purple">Activities</h1>
            <p class="text-muted mb-0">All budget activities across departments</p>
        </div>
    </div>

    <!-- Activities Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Activity</th>
                            <th scope="col">Department</th>
                            <th scope="col">Budget Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $activity->name }}</div>
                                @if($activity->code)
                                <small class="text-muted">Code: {{ $activity->code }}</small>
                                @endif
                            </td>
                            <td>{{ $activity->department->name }}</td>
                            <td>MWK {{ number_format($activity->budget_amount, 2) }}</td>
                            <td>
                                @php
                                    $statusClass = match($activity->status) {
                                        'completed' => 'bg-success text-white',
                                        'in_progress' => 'bg-primary text-white',
                                        'cancelled' => 'bg-danger text-white',
                                        default => 'bg-secondary text-white',
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} text-capitalize px-2 py-1">
                                    {{ str_replace('_', ' ', $activity->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('budget.activity.show', $activity->id) }}"
                                   class="text-orange fw-semibold text-decoration-none">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for NCHE Theme -->
<style>
    .text-purple {
        color: #5B2C6F !important;
    }

    .text-orange {
        color: #F39C12 !important;
    }

    .fw-semibold {
        font-weight: 600 !important;
    }

    .table-hover tbody tr:hover {
        background-color: #f9f2f7; /* subtle purple hover */
    }

    .badge.bg-primary {
        background-color: #5B2C6F !important;
    }

    .badge.bg-success {
        background-color: #28a745 !important;
    }

    .badge.bg-danger {
        background-color: #dc3545 !important;
    }

    .badge.bg-secondary {
        background-color: #6c757d !important;
    }
</style>
@endsection
