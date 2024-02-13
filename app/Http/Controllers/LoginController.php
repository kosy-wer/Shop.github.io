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
    $existingToken = $user->tokens()->where('expires_at', '>', now())->first();

if (!$existingToken) {
    // Jika tidak ada token yang masih berlaku, buat token baru
    $token = $user->createToken('token-name', ['expires_in' => 3600])->plainTextToken;
    return response()->json(['token' => $token]);
} else {
    // Token masih berlaku, Anda dapat melakukan tindakan lain jika diperlukan
    return response()->json(['message' => 'User already has a valid token']);
}

    
    } else {
    return back()
        ->withErrors(['password' => 'Password is incorrect'])
        ->withInput(['username' => $credentials['username'], 'remember' => $remember]);
}

}


}
