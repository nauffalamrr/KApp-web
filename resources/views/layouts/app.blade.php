<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kurir App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-white border-end p-3 shadow-sm" style="width: 220px; min-height: 100vh;">
        <h4 class="text-success fw-bold mb-4">Kurir App</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="/dashboard" class="nav-link text-dark {{ request()->is('dashboard') ? 'fw-bold' : '' }}">
                    🏠 Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="/drivers" class="nav-link text-dark {{ request()->is('drivers') ? 'fw-bold' : '' }}">
                    👤 Driver
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="/tasks" class="nav-link text-dark {{ request()->is('tasks') ? 'fw-bold' : '' }}">
                    📝 Task
                </a>
            </li>
            <li class="nav-item mb-4">
                <a href="/history" class="nav-link text-dark {{ request()->is('history') ? 'fw-bold' : '' }}">
                    ⏱️ History
                </a>
            </li>
            <li class="nav-item mt-auto">
                <a href="/logout" class="nav-link text-danger">
                    ⏏️ Sign out
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="p-4 w-100 bg-light">
        @yield('content')
    </div>
</div>
</body>
</html>
