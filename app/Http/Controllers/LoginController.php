<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use App\Services\TokenService;
class LoginController extends Controller
{
	protected $tokenService;
	public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }
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
if ($this->tokenService->isTokenValid($user)) {

    $token = $user->createToken('token-' . $user->email, ['expires_in' => now()->addHour()])->plainTextToken;

    return response()->json(['token' => $token]);
}


// Token masih berlaku, Anda dapat melakukan tindakan lain jika diperlukan
return response()->json(['message' => $existingToken . 'User already has a valid token']);   
    
    } else {
    return back()
        ->withErrors(['password' => 'Password is incorrect'])
        ->withInput(['username' => $credentials['username'], 'remember' => $remember]);
}

}
}
