<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
class LoginController extends Controller
{

	public function authenticate(Request $request)
{

    $request->validate([
        'username' => 'required|string|regex:/^[a-zA-Z0-9_@.-]+$/|email',
        'password' => 'required|string',
    ]);
    $credentials = $request->only('username', 'password');
    $remember = $request->has('remember');

    $user = User::where('email', $credentials['username'])
                ->orWhere('name', $credentials['username'])
                ->firstOr(function () use ($credentials) {
                    return User::create([
                        'name' => $credentials['username'],
                        'email' => $credentials['username'],
                        'password' => Hash::make($credentials['password']),
                    ]);
                });

    if (Hash::check($credentials['password'], $user->password)) {
Auth::login($user, $remember);
  $existingToken = $user->tokens()->first();  
 if (!$existingToken || !$this->isTokenValid($existingToken)) {
    // Jika tidak ada token yang masih berlaku atau waktu kedaluwarsanya habis, buat token baru dengan waktu kedaluwarsa 1 jam dari sekarang
    $token = $user->createToken('token-' . $user->email, ['expires_in' => now()->addHour()])->plainTextToken;
    return response()->json(['message' => $token]);
}

// Token masih berlaku, Anda dapat melakukan tindakan lain jika diperlukan
return response()->json(['message' => 'User already has a valid token']);   
    
    } else {
    return back()
        ->withErrors(['password' => 'Password is incorrect'])
        ->withInput(['username' => $credentials['username'], 'remember' => $remember]);
}

}

protected function isTokenValid($token)
{
    $abilities = $token->abilities;

    return isset($abilities['expires_in']) && now()->lessThan($abilities['expires_in']);
}
}
