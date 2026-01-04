@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Outcome Details</h4>
                    <div>
                        <a href="{{ route('outcomes.edit', $outcome) }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('outcomes.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back to Outcomes
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">ID</label>
                                <p class="form-control-plaintext">{{ $outcome->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Goal</label>
                                <p class="form-control-plaintext">{{ $outcome->goal->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pillar</label>
                                <p class="form-control-plaintext">{{ $outcome->goal->pillar->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <p class="form-control-plaintext">{{ $outcome->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <p class="form-control-plaintext">{{ $outcome->description ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Departments</label>
                        <ul class="list-group">
                            @forelse($outcome->departments as $department)
                            <li class="list-group-item">{{ $department->name }}</li>
                            @empty
                            <li class="list-group-item text-muted">No departments associated.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection