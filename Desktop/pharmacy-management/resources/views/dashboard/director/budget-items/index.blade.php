@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Budget Items</h4>
                    <a href="{{ route('budget-items.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-2"></i>Add Budget Item
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Activity</th>
                                    <th>Unit of Measure</th>
                                    <th>Quantity</th>
                                    <th>Unit Cost</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($budgetItems as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->activity->name }}</td>
                                    <td>{{ $item->unit_of_measure }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>MWK {{ number_format($item->unit_cost, 2) }}</td>
                                    <td>MWK {{ number_format($item->total, 2) }}</td>
                                    <td>
                                        <a href="{{ route('budget-items.show', $item) }}" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('budget-items.edit', $item) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <form method="POST" action="{{ route('budget-items.destroy', $item) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No budget items found.</td>
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