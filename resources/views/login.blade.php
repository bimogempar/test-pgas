<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <a href="{{ route('register') }}">Register page</a>
    <form method="POST" action="{{ route('doLogin') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
    @error('errorLogin')
        <div style="color: red;">{{ $message }}</div>
    @enderror
</body>

</html>
