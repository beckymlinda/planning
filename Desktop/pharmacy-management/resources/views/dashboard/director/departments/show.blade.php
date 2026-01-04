@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Department Details</h4>
                    <div>
                        <a href="{{ route('departments.edit', $department) }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('departments.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back to Departments
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">ID</label>
                                <p class="form-control-plaintext">{{ $department->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Code</label>
                                <p class="form-control-plaintext">{{ $department->code }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <p class="form-control-plaintext">{{ $department->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Outcome</label>
                        <p class="form-control-plaintext">
                            {{ $department->outcome->name }} ({{ $department->outcome->goal->name }} - {{ $department->outcome->goal->pillar->name }})
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <p class="form-control-plaintext">{{ $department->description ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Activities</label>
                        <ul class="list-group">
                            @forelse($department->activities as $activity)
                            <li class="list-group-item">{{ $activity->name }}</li>
                            @empty
                            <li class="list-group-item text-muted">No activities associated.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Users</label>
                        <ul class="list-group">
                            @forelse($department->users as $user)
                            <li class="list-group-item">{{ $user->name }} ({{ $user->email }})</li>
                            @empty
                            <li class="list-group-item text-muted">No users associated.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection