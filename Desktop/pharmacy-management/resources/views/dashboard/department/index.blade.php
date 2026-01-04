@extends('layouts.app')

@section('content')
<div class="dashboard">
    <h1>Department Dashboard</h1>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Budget</h3>
            <p class="stat-value">MWK {{ number_format($totalBudget, 2) }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Spent</h3>
            <p class="stat-value">MWK {{ number_format($totalSpent, 2) }}</p>
        </div>
        <div class="stat-card">
            <h3>Remaining</h3>
            <p class="stat-value">MWK {{ number_format($remainingBudget, 2) }}</p>
        </div>
    </div>

    <div class="section">
        <h2>My Activities</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Activity Name</th>
                    <th>Budget</th>
                    <th>Spent</th>
                    <th>Remaining</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                <tr>
                    <td>{{ $activity->name }}</td>
                    <td>MWK {{ number_format($activity->budget_amount, 2) }}</td>
                    <td>MWK {{ number_format($activity->total_paid, 2) }}</td>
                    <td>MWK {{ number_format($activity->remaining_budget, 2) }}</td>
                    <td><span class="badge badge-{{ $activity->status }}">{{ $activity->status }}</span></td>
                    <td>
                        <a href="{{ route('department.activity-statement', $activity->id) }}" class="btn-view">View Statement</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No activities found for your department.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

