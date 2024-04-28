<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
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

    public function login()
    {
        if (\Auth::check()) {
            return redirect()->back();
        }

        return view('admin.auth.login');
    }

    /**
     * Xử lý thực hiện đăng nhập trang admin
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        $data = $request->except('_token');
        $user = $this->user->getInfoEmail($data['email']);

        if (!$user) {
            return redirect()->back()->with('error', 'Thông tin tài khoản không tồn tại');
        }

        if ($user->status == User::LOCK) {
            return redirect()->back()->with('error', 'Tài khoản của bạn đã bị khóa');
        }
        if (Auth::attempt($data)) {
            return redirect()->route('admin.home');
        }
        return redirect()->back()->with('error', 'Đăng nhập thất bại.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
