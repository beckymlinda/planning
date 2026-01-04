@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Create New Activity
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('activities.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="department_id" class="form-label fw-semibold">Department</label>
                            <select id="department_id" name="department_id" class="form-select" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }} ({{ $department->outcome->name }} - {{ $department->outcome->goal->name }} - {{ $department->outcome->goal->pillar->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="code" class="form-label fw-semibold">Activity Code</label>
                                <input type="text" id="code" name="code" value="{{ old('code') }}" class="form-control" placeholder="e.g., ACT001" required>
                                @error('code')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Activity Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter activity name" required>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="budget_year" class="form-label fw-semibold">Budget Year</label>
                                <select id="budget_year" name="budget_year" class="form-select" required>
                                    @for($year = date('Y') - 1; $year <= date('Y') + 2; $year++)
                                        <option value="{{ $year }}" {{ old('budget_year', date('Y')) == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('budget_year')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="status" class="form-label fw-semibold">Status</label>
                                <input type="number" id="budget_amount" name="budget_amount" value="{{ old('budget_amount') }}" class="form-control" step="0.01" min="0" placeholder="0.00" required>
                                @error('budget_amount')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="status" class="form-label fw-semibold">Status</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="">Select Status</option>
                                    <option value="planned" {{ old('status') == 'planned' ? 'selected' : '' }}>Planned</option>
                                    <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label fw-semibold">Start Date</label>
                                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" class="form-control" required>
                                @error('start_date')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label fw-semibold">End Date</label>
                                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" class="form-control" required>
                                @error('end_date')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control" placeholder="Enter activity description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mt-4">
                            <a href="{{ route('activities.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Activities
                            </a>
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-save me-2"></i>Create Activity
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection