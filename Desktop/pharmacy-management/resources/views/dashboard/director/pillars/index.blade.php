@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Pillars</h4>
                    <a href="{{ route('pillars.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-2"></i>Add Pillar
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Goals Count</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pillars as $pillar)
                                <tr>
                                    <td>{{ $pillar->id }}</td>
                                    <td>{{ $pillar->name }}</td>
                                    <td>{{ $pillar->description ?? 'N/A' }}</td>
                                    <td>{{ $pillar->goals->count() }}</td>
                                    <td>
                                        <a href="{{ route('pillars.show', $pillar) }}" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('pillars.edit', $pillar) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        <form method="POST" action="{{ route('pillars.destroy', $pillar) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No pillars found.</td>
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