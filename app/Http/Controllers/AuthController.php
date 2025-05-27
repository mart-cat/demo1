<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     public function showReg() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'fio' => ['required', 'regex:/^[А-Яа-яЁё\s]+$/u'],
            'phone' => ['required', 'regex:/^\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}$/'],
            'email' => ['required', 'email', 'unique:users'],
            'login' => ['required', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);

        $user = User::create([
            'fio' => $request->fio,
            'phone' => $request->phone,
            'email' => $request->email,
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ]);

        Auth::login($user);
        return redirect('/orders');
    }

    public function show() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();
            if(Auth::user()->role->name === 'admin') {
                return redirect('/admin');
            }
            return redirect('/orders');
        }
        return back()->withErrors(['login' => 'Неверный логин или пароль']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
