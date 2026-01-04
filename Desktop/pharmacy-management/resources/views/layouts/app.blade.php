<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Pharmacy Management') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --purple: #5B2C6F; /* NCHE Purple */
            --orange: #F39C12; /* NCHE Orange */
        }

        body {
            background-color: #f8f9fa;
        }

        /* Sidebar */
        #sidebar {
            min-width: 220px;
            max-width: 220px;
            background-color: var(--purple);
            color: white;
            transition: all 0.3s;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 1000;
        }

        #sidebar .nav-link {
            color: white;
            transition: background 0.2s;
        }

        #sidebar .nav-link:hover {
            background-color: var(--orange);
            color: white;
        }

        #sidebar .sidebar-header {
            padding: 1rem;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        #content {
            margin-left: 220px;
            transition: margin-left 0.3s;
            width: calc(100% - 220px);
        }

        /* Top navbar */
        .top-navbar {
            background-color: white;
            border-bottom: 1px solid #ddd;
        }

        .top-navbar .navbar-brand {
            color: var(--purple);
            font-weight: bold;
        }

        .btn-logout {
            background-color: var(--orange);
            color: white;
            border-radius: 5px;
        }

        .btn-logout:hover {
            background-color: darkorange;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -220px;
                position: fixed;
                height: 100vh;
            }

            #sidebar.show {
                margin-left: 0;
            }

            #content {
                margin-left: 0;
                width: 100%;
                padding: 0 15px;
            }

            /* Mobile navbar improvements */
            .top-navbar .navbar-brand {
                font-size: 1rem;
            }

            .top-navbar .d-flex.ms-auto span {
                display: none;
            }

            /* Mobile search form */
            .top-navbar .d-flex.mx-3 {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                max-width: calc(100vw - 120px);
            }

            .top-navbar .d-flex.mx-3 .input-group {
                max-width: 200px;
            }

            /* Mobile table improvements */
            .table-responsive {
                font-size: 0.875rem;
            }

            .table-responsive th,
            .table-responsive td {
                padding: 0.5rem;
                white-space: nowrap;
            }

            /* Mobile card improvements */
            .card-body {
                padding: 1rem 0.75rem;
            }

            /* Mobile form improvements */
            .form-control, .form-select {
                font-size: 16px; /* Prevent zoom on iOS */
            }

            .btn {
                min-height: 44px; /* Touch target size */
                font-size: 16px;
            }

            /* Mobile table improvements */
            .table-responsive {
                font-size: 0.875rem;
            }

            .table-responsive th,
            .table-responsive td {
                padding: 0.5rem;
                white-space: nowrap;
            }

            /* Hide less important table columns on mobile */
            @media (max-width: 576px) {
                .table-responsive .table th:nth-child(n+5),
                .table-responsive .table td:nth-child(n+5) {
                    display: none;
                }
            }
        }

        @media (max-width: 576px) {
            .top-navbar .d-flex.mx-3 {
                display: none; /* Hide search on very small screens */
            }

            .container-fluid {
                padding-left: 10px;
                padding-right: 10px;
            }

            .card-header h4 {
                font-size: 1.1rem;
            }

            .card-header h5 {
                font-size: 1rem;
            }

            /* Stack buttons vertically on small screens */
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 0.5rem;
            }

            .d-flex.justify-content-between .btn {
                width: 100%;
            }

            /* Mobile form improvements */
            .row.g-3 .col-md-3 {
                margin-bottom: 1rem;
            }

            /* Mobile table improvements */
            .table-responsive .table th:nth-child(n+4),
            .table-responsive .table td:nth-child(n+4) {
                display: none;
            }

            .table-responsive .table th:last-child,
            .table-responsive .table td:last-child {
                display: table-cell;
                width: 60px;
            }

            /* Mobile card improvements */
            .card .card-body .row .col-md-6 {
                margin-bottom: 1rem;
            }

            /* Mobile select improvements */
            .form-select option {
                font-size: 1rem;
            }
        }

        /* Search result card borders */
        .border-left-pillar { border-left: 4px solid #0dcaf0 !important; }
        .border-left-goal { border-left: 4px solid #198754 !important; }
        .border-left-outcome { border-left: 4px solid #ffc107 !important; }
        .border-left-department { border-left: 4px solid #6c757d !important; }
        .border-left-activity { border-left: 4px solid #000 !important; }
        .border-left-budget-item { border-left: 4px solid #dc3545 !important; }
        .border-left-payment { border-left: 4px solid #0d6efd !important; }
        .border-left-user { border-left: 4px solid #f8f9fa !important; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div id="sidebar" class="d-flex flex-column">
    <div class="sidebar-header">
        Budget Management
    </div>

   

    <ul class="nav flex-column px-2 mt-2">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('search') }}" class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}">
                <i class="fas fa-search me-2"></i>Search
            </a>
        </li>
    </ul>

    <div class="px-3 mt-4">
        <p class="text-uppercase small mb-2">Budget Management</p>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('budget.departments') }}" class="nav-link {{ request()->routeIs('budget.departments*') ? 'active' : '' }}">
                    <i class="fas fa-building me-2"></i>Departments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('budget.activities') }}" class="nav-link {{ request()->routeIs('budget.activities*') ? 'active' : '' }}">
                    <i class="fas fa-tasks me-2"></i>Activities
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('budget.budget-items') }}" class="nav-link {{ request()->routeIs('budget.budget-items*') ? 'active' : '' }}">
                    <i class="fas fa-list me-2"></i>Budget Items
                </a>
            </li>
        </ul>
    </div>

    @if(auth()->check() && auth()->user()->role === 'accounts')
    <div class="px-3 mt-4">
        <p class="text-uppercase small mb-2">Accounts</p>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('accounts.dashboard') }}" class="nav-link {{ request()->routeIs('accounts.dashboard*') ? 'active' : '' }}">
                    Payments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('accounts.create-payment') }}" class="nav-link {{ request()->routeIs('accounts.create-payment*') ? 'active' : '' }}">
                    Create Payment
                </a>
            </li>
            
            
        </ul>
    </div>
    @endif

    @if(auth()->check() && auth()->user()->role === 'director')
    <div class="px-3 mt-4">
        <p class="text-uppercase small mb-2">Budget Allocation</p>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('pillars.index') }}" class="nav-link {{ request()->routeIs('pillars*') ? 'active' : '' }}">
                    Pillars
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('goals.index') }}" class="nav-link {{ request()->routeIs('goals*') ? 'active' : '' }}">
                    Goals
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('outcomes.index') }}" class="nav-link {{ request()->routeIs('outcomes*') ? 'active' : '' }}">
                    Outcomes
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('departments.index') }}" class="nav-link {{ request()->routeIs('departments*') ? 'active' : '' }}">
                    Departments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('activities.index') }}" class="nav-link {{ request()->routeIs('activities*') ? 'active' : '' }}">
                    Activities
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('budget-items.index') }}" class="nav-link {{ request()->routeIs('budget-items*') ? 'active' : '' }}">
                    Budget Items
                </a>
            </li>
        </ul>
    </div>
    @endif

    <div class="mt-auto px-3 py-3 border-top">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-logout w-100">Log Out</button>
        </form>
    </div>
</div>

<!-- Main content -->
<div id="content">
    <!-- Top Navbar -->
    <nav class="navbar top-navbar mb-4">
        <div class="container-fluid">
            <button class="btn btn-purple d-md-none me-2" id="sidebarToggle">&#9776;</button>
            <a class="navbar-brand" href="#"><B>Budget</B> Management</a>

            <!-- Search Form -->
            <form method="GET" action="{{ route('search') }}" class="d-flex mx-3 flex-grow-1" style="max-width: 400px;">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..." value="{{ request('q') }}" style="border-radius: 0.375rem 0 0 0.375rem;">
                    <button class="btn btn-outline-light" type="submit" style="border-radius: 0 0.375rem 0.375rem 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <div class="d-flex ms-auto">
                <span class="me-2 d-none d-sm-block">Hello, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-logout btn-sm">Log Out</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Page Heading -->
    @isset($header)
        <div class="bg-light p-3 mb-3 rounded shadow-sm">
            {{ $header }}
        </div>
    @endisset

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar Toggle Script -->
<script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });
</script>

</body>
</html>
