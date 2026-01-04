@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Goal Details</h4>
                    <div>
                        <a href="{{ route('goals.edit', $goal) }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('goals.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back to Goals
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">ID</label>
                                <p class="form-control-plaintext">{{ $goal->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <p class="form-control-plaintext">{{ $goal->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pillar</label>
                        <p class="form-control-plaintext">{{ $goal->pillar->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <p class="form-control-plaintext">{{ $goal->description ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Outcomes</label>
                        <ul class="list-group">
                            @forelse($goal->outcomes as $outcome)
                            <li class="list-group-item">{{ $outcome->name }}</li>
                            @empty
                            <li class="list-group-item text-muted">No outcomes associated.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection