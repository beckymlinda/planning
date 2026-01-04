@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Department
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('departments.update', $department) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="outcome_id" class="form-label fw-semibold">Outcome</label>
                            <select id="outcome_id" name="outcome_id" class="form-select" required>
                                <option value="">Select Outcome</option>
                                @foreach($outcomes as $outcome)
                                    <option value="{{ $outcome->id }}" {{ old('outcome_id', $department->outcome_id) == $outcome->id ? 'selected' : '' }}>
                                        {{ $outcome->name }} ({{ $outcome->goal->name }} - {{ $outcome->goal->pillar->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('outcome_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="code" class="form-label fw-semibold">Department Code</label>
                                <input type="text" id="code" name="code" value="{{ old('code', $department->code) }}" class="form-control" placeholder="e.g., DEP001" required>
                                @error('code')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Department Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $department->name) }}" class="form-control" placeholder="Enter department name" required>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control" placeholder="Enter department description">{{ old('description', $department->description) }}</textarea>
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('departments.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Departments
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>Update Department
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection