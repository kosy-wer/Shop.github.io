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
    $hasTokens = $user->tokens()->exists();

	if ($hasTokens) {
                // User has tokens
                return response()->json(['token' => 'User has tokens']);
            } else {
    $token = $user->createToken('token-name', ['expires_in' => 3600])->plainTextToken;
                // User doesn't have tokens
                return response()->json(['token' => 'User does not have tokens']);
            }






} else {
    return back()
        ->withErrors(['password' => 'Password is incorrect'])
        ->withInput(['username' => $credentials['username'], 'remember' => $remember]);
}

}


}
