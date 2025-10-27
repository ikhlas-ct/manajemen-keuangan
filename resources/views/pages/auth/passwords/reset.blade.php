<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">Reset Password</h2>

        {{-- Pesan Error --}}
        @error('email')
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded-lg mb-4">
                {{ $message }}
            </div>
        @enderror

        @error('password')
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded-lg mb-4">
                {{ $message }}
            </div>
        @enderror

        {{-- Form Reset Password --}}
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Alamat Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ $email ?? old('email') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Masukkan email anda"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password Baru</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Masukkan password baru"
                    required
                >
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Ulangi password baru"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                Reset Password
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                Kembali ke Login
            </a>
        </div>
    </div>

</body>
</html>
