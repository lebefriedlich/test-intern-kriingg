<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $messages = [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ];

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], $messages);

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::with('role')->where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);

            $role_name = $user->role->nama_role;
            
            if ($role_name === 'Karyawan') {
                return redirect('/karyawan');
            } elseif ($role_name === 'Admin') {
                return redirect('/admin');
            } elseif ($role_name === 'Direktur') {
                return redirect('/direktur');
            }
        }

        return redirect('/')->with('error', 'Username atau password salah.')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
