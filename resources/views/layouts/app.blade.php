<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kurir App</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="d-flex flex-column justify-content-between bg-white border-end p-3 shadow-sm" style="width: 220px; min-height: 100vh;">
        <div>
            <a href="/dashboard" class="text-success fw-bold mb-4 text-decoration-none d-block fs-4">Kurir App</a>
            <ul class="nav flex-column">

                <li class="nav-item mb-2">
                    <a href="/dashboard" class="nav-link text-dark d-flex align-items-center {{ request()->is('dashboard') ? 'fw-bold active' : '' }}">
                        {!! file_get_contents(public_path('icons/home.svg')) !!}
                        <span class="ms-2">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="/drivers" class="nav-link text-dark d-flex align-items-center {{ request()->is('drivers') ? 'fw-bold active' : '' }}">
                        {!! file_get_contents(public_path('icons/profile.svg')) !!}
                        <span class="ms-2">Driver</span>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="/tasks" class="nav-link text-dark d-flex align-items-center {{ request()->is('tasks') ? 'fw-bold active' : '' }}">
                        {!! file_get_contents(public_path('icons/task.svg')) !!}
                        <span class="ms-2">Task</span>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="/history" class="nav-link text-dark d-flex align-items-center {{ request()->is('history') ? 'fw-bold active' : '' }}">
                        {!! file_get_contents(public_path('icons/history.svg')) !!}
                        <span class="ms-2">History</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="mt-auto pt-4 border-top">
            <a href="/logout" class="nav-link text-dark d-flex align-items-center">
                {!! file_get_contents(public_path('icons/signout.svg')) !!}
                <span class="ms-2">Sign out</span>
            </a>
        </div>
    </div>


    <!-- Content -->
    <div class="p-4 w-100 bg-light">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
