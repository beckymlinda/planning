@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h4 fw-bold text-purple">Budget Items</h1>
                <p class="text-muted mb-0">Detailed breakdown of all budget items</p>
            </div>
        </div>
    </div>

    <!-- Budget Items Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Activity</th>
                            <th>Department</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Frequency</th>
                            <th>Unit Cost</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($budgetItems as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->name }}</td>
                            <td>{{ $item->activity->name }}</td>
                            <td>{{ $item->activity->department->name }}</td>
                            <td>{{ $item->unit_of_measure ?? 'N/A' }}</td>
                            <td>{{ number_format($item->quantity, 2) }}</td>
                            <td>{{ $item->frequency }}</td>
                            <td>MWK {{ number_format($item->unit_cost, 2) }}</td>
                            <td class="fw-semibold">MWK {{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for NCHE Theme -->
<style>
    .text-purple { color: #5B2C6F !important; }
    .fw-semibold { font-weight: 600 !important; }
    .table-hover tbody tr:hover { background-color: #f2f0f7; } /* subtle purple hover */
</style>
@endsection
