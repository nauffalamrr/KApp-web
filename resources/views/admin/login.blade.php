<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body class="login-page">
    <div class="login-container">
        <h2 class="login-title">Welcome Back!</h2>
        <p class="login-subtitle">Please enter your credential to continue</p>

        @if($errors->has('login'))
            <div class="error-message">{{ $errors->first('login') }}</div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <input type="text" class="form-control" name="username" placeholder="Username or email" />
            <input type="password" class="form-control" name="password" placeholder="Password" />
            <button class="btn-login" type="submit">Log In</button>
        </form>
    </div>
</body>
</html>