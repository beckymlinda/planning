@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Outcomes</h4>
                    <a href="{{ route('outcomes.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-2"></i>Add Outcome
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Goal</th>
                                    <th>Pillar</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Departments Count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($outcomes as $outcome)
                                <tr>
                                    <td>{{ $outcome->id }}</td>
                                    <td>{{ $outcome->goal->name }}</td>
                                    <td>{{ $outcome->goal->pillar->name }}</td>
                                    <td>{{ $outcome->name }}</td>
                                    <td>{{ $outcome->description ?? 'N/A' }}</td>
                                    <td>{{ $outcome->departments->count() }}</td>
                                    <td>
                                        <a href="{{ route('outcomes.show', $outcome) }}" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('outcomes.edit', $outcome) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <form method="POST" action="{{ route('outcomes.destroy', $outcome) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No outcomes found.</td>
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