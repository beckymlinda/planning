@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-search me-2"></i>Search Results
                        @if($query)
                            <small class="text-white-50">for "{{ $query }}"</small>
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    @if(!$query)
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Enter a search term to find results</h5>
                            <form method="GET" action="{{ route('search') }}" class="mt-3">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="q" class="form-control" placeholder="Search for activities, payments, departments..." required>
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @elseif($total == 0)
                        <div class="text-center py-5">
                            <i class="fas fa-search-minus fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No results found for "{{ $query }}"</h5>
                            <p class="text-muted">Try different keywords or check your spelling</p>
                            <a href="{{ route('search') }}" class="btn btn-outline-primary">
                                <i class="fas fa-search me-1"></i>New Search
                            </a>
                        </div>
                    @else
                        <div class="mb-3">
                            <p class="text-muted">Found {{ $total }} result{{ $total > 1 ? 's' : '' }}</p>
                            <div class="alert alert-info small">
                                <i class="fas fa-info-circle me-1"></i>
                                Some results may be restricted based on your user role. Contact your administrator for access to additional features.
                            </div>
                        </div>

                        <div class="row">
                            @foreach($results as $result)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3">
                                <div class="card h-100 border-left-{{ strtolower(str_replace(' ', '-', $result['type'])) }} shadow-sm">
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="badge bg-{{ strtolower(str_replace(' ', '-', $result['type'])) == 'pillar' ? 'info' : (strtolower(str_replace(' ', '-', $result['type'])) == 'goal' ? 'success' : (strtolower(str_replace(' ', '-', $result['type'])) == 'outcome' ? 'warning' : (strtolower(str_replace(' ', '-', $result['type'])) == 'department' ? 'secondary' : (strtolower(str_replace(' ', '-', $result['type'])) == 'activity' ? 'dark' : (strtolower(str_replace(' ', '-', $result['type'])) == 'budget-item' ? 'danger' : (strtolower(str_replace(' ', '-', $result['type'])) == 'payment' ? 'primary' : 'light')))))) }} fs-6">
                                                {{ $result['type'] }}
                                            </span>
                                        </div>
                                        <h6 class="card-title flex-grow-1">
                                            @if($result['url'] !== '#')
                                                <a href="{{ $result['url'] }}" class="text-decoration-none">{{ $result['title'] }}</a>
                                            @else
                                                <span class="text-muted">{{ $result['title'] }}</span>
                                                <small class="text-warning d-block">(Access restricted)</small>
                                            @endif
                                        </h6>
                                        @if($result['description'])
                                            <p class="card-text small text-muted mb-2">{{ Str::limit($result['description'], 100) }}</p>
                                        @endif
                                        <small class="text-muted mt-auto">{{ $result['meta'] }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('search') }}" class="btn btn-outline-primary">
                                <i class="fas fa-search me-1"></i>New Search
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection