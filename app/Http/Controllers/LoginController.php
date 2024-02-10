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


    $token = $user->createToken('token-name', ['expires_in' => 3600])->plainTextToken;


    $tokens = PersonalAccessToken::where('tokenable_type', get_class($user))
                ->where('tokenable_id', $user->id)
                ->get();



    return response()->json(['token' => $token]);
} else {
    return back()
        ->withErrors(['password' => 'Password is incorrect'])
        ->withInput(['username' => $credentials['username'], 'remember' => $remember]);
}

}


}
