@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Goals</h4>
                    <a href="{{ route('goals.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-2"></i>Add Goal
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Pillar</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Outcomes Count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($goals as $goal)
                                <tr>
                                    <td>{{ $goal->id }}</td>
                                    <td>{{ $goal->pillar->name }}</td>
                                    <td>{{ $goal->name }}</td>
                                    <td>{{ $goal->description ?? 'N/A' }}</td>
                                    <td>{{ $goal->outcomes->count() }}</td>
                                    <td>
                                        <a href="{{ route('goals.show', $goal) }}" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('goals.edit', $goal) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <form method="POST" action="{{ route('goals.destroy', $goal) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No goals found.</td>
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