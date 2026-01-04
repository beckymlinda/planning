@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Departments</h4>
                    <a href="{{ route('departments.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-2"></i>Add Department
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
                                    <th>Outcome</th>
                                    <th>Goal</th>
                                    <th>Pillar</th>
                                    <th>Activities Count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($departments as $department)
                                <tr>
                                    <td>{{ $department->id }}</td>
                                    <td>{{ $department->code }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->outcome->name }}</td>
                                    <td>{{ $department->outcome->goal->name }}</td>
                                    <td>{{ $department->outcome->goal->pillar->name }}</td>
                                    <td>{{ $department->activities->count() }}</td>
                                    <td>
                                        <a href="{{ route('departments.show', $department) }}" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <form method="POST" action="{{ route('departments.destroy', $department) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No departments found.</td>
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