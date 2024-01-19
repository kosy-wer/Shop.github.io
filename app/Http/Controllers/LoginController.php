<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
        
        // Cek apakah pengguna ada di tabel users
        $user = User::where('email', $credentials['username'])
                    ->orWhere('name', $credentials['username'])
                    ->first();

        if ($user) {
            // Pengguna sudah ada, periksa kata sandi
            if (Hash::check($credentials['password'], $user->password)) {
                // Autentikasi berhasil
                return redirect()->intended('Home');
            } else {
                // Kata sandi tidak cocok
                return back()->withErrors(['username' => 'Invalid credentials']);
            }
        } else {
            // Pengguna tidak ada, buat pengguna baru
            $newUser = User::create([
                'name' => $credentials['username'],
                'email' => $credentials['username'], // Disesuaikan sesuai kebutuhan
                'password' => Hash::make($credentials['password']),
            ]);

            // Autentikasi pengguna baru
            Auth::login($newUser);

            return redirect()->intended('Home');
        }
    }
}
