<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - STARS</title>
    <style>
        /* ... CSS Anda di sini ... */
    </style>
</head>
<body>
    <div class="login-container">
        <h1>STARS</h1>
        <p>Sistem Tagihan Dan Pembayaran Sekolah</p>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="username">NIP / NIS</label>
                {{-- PERBAIKAN: Ditambahkan autocomplete="username" --}}
                <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus autocomplete="username">
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                {{-- PERBAIKAN: Ditambahkan autocomplete="current-password" --}}
                <input type="password" id="password" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label>
                    <input type="checkbox" name="remember"> Ingat Saya
                </label>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>
</html>
