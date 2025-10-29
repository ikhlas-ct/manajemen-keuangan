<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
        public function index()
    {
        return view('pages.auth.login.login');
    }


public function login_post(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // berhasil login, regenerasi session
        $request->session()->regenerate();

        $user = Auth::user();

        $allowedRoles = ['admin', 'manajer'];

        if (empty($user->role) || !in_array($user->role, $allowedRoles, true)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'role' => 'Email dan Password Salah.',
            ])->onlyInput('email');
        }

        // redirect berdasarkan role
        if ($user->role === 'staf_operasional') {
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai Staf Operasional!');
        } elseif ($user->role === 'manajer') {
            return redirect()->route('manajer.dashboard')->with('success', 'Login berhasil sebagai Manajer!');
        } else {
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }
    }

    // credentials salah
    return back()->withErrors([
        'user_name' => 'Kode unik atau password salah.',
    ])->onlyInput('user_name');
}


}
