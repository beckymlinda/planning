@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Create New Budget Item
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('budget-items.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="activity_id" class="form-label fw-semibold">Activity</label>
                            <select id="activity_id" name="activity_id" class="form-select" required>
                                <option value="">Select Activity</option>
                                @foreach($activities as $activity)
                                    <option value="{{ $activity->id }}" {{ old('activity_id') == $activity->id ? 'selected' : '' }}>
                                        {{ $activity->name }} ({{ $activity->department->name }} - {{ $activity->department->outcome->name }} - {{ $activity->department->outcome->goal->name }} - {{ $activity->department->outcome->goal->pillar->name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('activity_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">Item Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter item name" required>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="unit_of_measure" class="form-label fw-semibold">Unit of Measure</label>
                                <input type="text" id="unit_of_measure" name="unit_of_measure" value="{{ old('unit_of_measure') }}" class="form-control" placeholder="e.g., kg, pieces" required>
                                @error('unit_of_measure')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label fw-semibold">Quantity</label>
                                <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" class="form-control" step="0.01" min="0" placeholder="0.00" required>
                                @error('quantity')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="frequency" class="form-label fw-semibold">Frequency</label>
                                <input type="number" id="frequency" name="frequency" value="{{ old('frequency') }}" class="form-control" min="1" placeholder="1" required>
                                @error('frequency')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="unit_cost" class="form-label fw-semibold">Unit Cost (MWK)</label>
                                <input type="number" id="unit_cost" name="unit_cost" value="{{ old('unit_cost') }}" class="form-control" step="0.01" min="0" placeholder="0.00" required>
                                @error('unit_cost')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="total" class="form-label fw-semibold">Total (MWK)</label>
                                <input type="number" id="total" name="total" value="{{ old('total') }}" class="form-control" step="0.01" min="0" placeholder="0.00" required>
                                @error('total')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control" placeholder="Enter item description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('budget-items.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Budget Items
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-save me-2"></i>Create Budget Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection