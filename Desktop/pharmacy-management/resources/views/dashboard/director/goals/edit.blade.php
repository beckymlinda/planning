@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Goal
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('goals.update', $goal) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="pillar_id" class="form-label fw-semibold">Pillar</label>
                            <select id="pillar_id" name="pillar_id" class="form-select" required>
                                <option value="">Select Pillar</option>
                                @foreach($pillars as $pillar)
                                    <option value="{{ $pillar->id }}" {{ old('pillar_id', $goal->pillar_id) == $pillar->id ? 'selected' : '' }}>
                                        {{ $pillar->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pillar_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Goal Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $goal->name) }}" class="form-control" placeholder="Enter goal name" required>
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control" placeholder="Enter goal description">{{ old('description', $goal->description) }}</textarea>
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('goals.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Goals
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>Update Goal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection