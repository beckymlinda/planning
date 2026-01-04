@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Activities</h4>
                    <a href="{{ route('activities.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-2"></i>Add Activity
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Budget Amount</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities as $activity)
                                <tr>
                                    <td>{{ $activity->id }}</td>
                                    <td>{{ $activity->code }}</td>
                                    <td>{{ $activity->name }}</td>
                                    <td>{{ $activity->department->name }}</td>
                                    <td>MWK {{ number_format($activity->budget_amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $activity->status == 'completed' ? 'success' : ($activity->status == 'ongoing' ? 'primary' : 'secondary') }}">
                                            {{ ucfirst($activity->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $activity->start_date ? $activity->start_date->format('Y-m-d') : 'N/A' }}</td>
                                    <td>{{ $activity->end_date ? $activity->end_date->format('Y-m-d') : 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('activities.show', $activity) }}" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('activities.edit', $activity) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <form method="POST" action="{{ route('activities.destroy', $activity) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No activities found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection