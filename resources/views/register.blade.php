<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <a href="{{ route('register') }}">Login page</a>
    <form method="POST" action="{{ route('submitRegister') }}">
        @csrf

        <div>
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" required>
        </div>

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
</body>

</html>
