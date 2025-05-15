<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <div class="bg-dark text-white p-3" style="width: 200px; min-height: 100vh;">
        <h5>Admin Menu</h5>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="/dashboard" class="nav-link text-white">Dashboard</a></li>
            <li class="nav-item"><a href="/drivers" class="nav-link text-white">Drivers</a></li>
            <li class="nav-item"><a href="/tasks" class="nav-link text-white">Tasks</a></li>
            <li class="nav-item"><a href="/history" class="nav-link text-white">History</a></li>
            <li class="nav-item"><a href="/logout" class="nav-link text-white">Sign Out</a></li>
        </ul>
    </div>
    <div class="p-4 w-100">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>