@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Create New Outcome
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('outcomes.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="goal_id" class="form-label fw-semibold">Goal</label>
                            <select id="goal_id" name="goal_id" class="form-select" required>
                                <option value="">Select Goal</option>
                                @foreach($goals as $goal)
                                    <option value="{{ $goal->id }}" {{ old('goal_id') == $goal->id ? 'selected' : '' }}>
                                        {{ $goal->name }} ({{ $goal->pillar->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('goal_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Outcome Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter outcome name" required>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control" placeholder="Enter outcome description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('outcomes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Outcomes
                            </a>
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-save me-2"></i>Create Outcome
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection