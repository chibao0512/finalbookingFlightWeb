<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $user;
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(User $user)
    {
        $this->middleware('guest')->except('logout');
        $this->user = $user;
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $credentials = $request->only('email', 'password');

            $user = $this->user->where('email', $credentials['email'])->first();

            if (!$user) {
                return response()->json([
                    "code" => 400,
                    "message" => "User not found.",
                ], 400);
            }

            if ($user->status == User::LOCK) {
                return response()->json([
                    "code" => 403,
                    "message" => "Account is locked.",
                ], 403);
            }

            if (!Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    "code" => 400,
                    "message" => "Invalid credentials.",
                ], 400);
            }

            $token = auth('api')->attempt($credentials);

            if ($token) {
                $userArray = $user->toArray();
                $userArray['token'] = $token;
                return response()->json([
                    "code" => 200,
                    "data" => $userArray,
                    "message" => "Login successful.",
                ], 200);
            } else {
                return response()->json([
                    "code" => 400,
                    "message" => "Login failed.",
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                "code" => 400,
                "message" => "An error occurred during login.",
                "error" => $e->getMessage(),
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        try {
            $accessToken = JWTAuth::getToken();
            JWTAuth::invalidate($accessToken);
            return response()->json([
                "code" => 200,
                "message" => "Logout successful.",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "code" => 400,
                "message" => "Logout failed.",
                "error" => $e->getMessage(),
            ], 400);
        }
    }
}
