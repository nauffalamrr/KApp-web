<!DOCTYPE html>
<html>
<head><title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Login Admin</div>
                <div class="card-body">
                    <form method="POST" action="/login">
                        @csrf
                        <div class="mb-3"><input type="text" name="username" class="form-control" placeholder="Username"></div>
                        <div class="mb-3"><input type="password" name="password" class="form-control" placeholder="Password"></div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>