<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected $user;
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('guest')->except('logout');
        $this->user = $user;
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            $user = $this->user->getInfoEmail($credentials['email']);

            if (!$user) {
                return response([
                    "code" => 400,
                    "message" => "Thất bại",
                ]);
            }

            if ($user->status == User::LOCK) {
                return response([
                    "code" => 403,
                    "message" => "Tài khoản đã bị khóa",
                ]);
            }

            $token = auth('api')->attempt($credentials);

            if ($token) {
                $user = auth('api')->user()->toArray();
                $user['token'] = $token;
                return response([
                    "code" => 200,
                    "data" => $user,
                    "message" => "Thành công",
                ]);
            } else {
                return response([
                    "code" => 400,
                    "message" => "Thất bại",
                ]);
            }
        } catch (\Exception $e) {
            return response([
                "code" => 400,
                "message" => "Thất bại",
            ]);
        }

    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $accessToken = JWTAuth::getToken();
            JWTAuth::invalidate($accessToken);
            return response([
                "code" => 200,
                "message" => "Thành công",
            ]);
        } catch (\Exception $e) {
            return response([
                "code" => 400,
                "message" => "Thất bại",
            ]);
        }

    }
}
