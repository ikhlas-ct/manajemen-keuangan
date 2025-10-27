<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">Lupa Password</h2>

        {{-- Pesan sukses jika link reset terkirim --}}
        @if (session('status'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-4">
                {{ session('status') }}
            </div>
        @endif

        {{-- Pesan error untuk email --}}
        @error('success')
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded-lg mb-4">
                {{ $message }}
            </div>
        @enderror

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Alamat Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Masukkan email anda"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                Kirim Link Reset Password
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                Kembali ke halaman login
            </a>
        </div>
    </div>

</body>
</html>
